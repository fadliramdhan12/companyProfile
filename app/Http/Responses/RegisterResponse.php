<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request): JsonResponse|RedirectResponse
    {
        /** @var Request $request */
        Auth::guard((string) config('fortify.guard', 'web'))->logout();

        if ($request->hasSession()) {
            $request->session()->regenerateToken();
        }

        return $request->wantsJson()
            ? new JsonResponse(['redirect' => route('login')], 201)
            : redirect()->route('login')->with('status', __('Registration successful. Please log in.'));
    }
}
