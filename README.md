# companyProfile

Company profile web application built with Laravel, Livewire, Flux UI, Fortify, Vite, and Tailwind CSS.

## Tech Stack

- PHP 8.3
- Laravel 13
- Laravel Fortify
- Livewire 4
- Flux UI 2
- Tailwind CSS 4
- Vite
- Pest PHP

## Main Features

- Authentication with Laravel Fortify
- Register with name, username, email, and password
- Login with username and password
- Register success redirects to login instead of logging the user in automatically
- Protected dashboard route
- User settings pages for profile, appearance, and security

## Requirements

- PHP 8.3 or newer
- Composer
- Node.js and npm
- MySQL or SQLite

## Installation

Clone the repository, then install PHP and JavaScript dependencies:

```bash
composer install
npm install
```

Create the environment file and generate the application key:

```bash
cp .env.example .env
php artisan key:generate
```

Configure the database in `.env`.

For SQLite:

```env
DB_CONNECTION=sqlite
```

For MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=company_profile
DB_USERNAME=root
DB_PASSWORD=
```

Run the migrations:

```bash
php artisan migrate
```

## Development

Run the Laravel server, queue listener, and Vite dev server together:

```bash
composer run dev
```

Open the application at:

```text
http://127.0.0.1:8000
```

You can also run the services manually in separate terminals:

```bash
php artisan serve
npm run dev
```

## Authentication Flow

Auth routes are registered by Laravel Fortify. The views are configured in:

```text
app/Providers/FortifyServiceProvider.php
```

Auth views are stored in:

```text
resources/views/pages/auth/login.blade.php
resources/views/pages/auth/register.blade.php
```

Current flow:

1. User registers at `/register`.
2. The account is created with a unique `username`.
3. The user is redirected to `/login`.
4. The user logs in with `username` and password.
5. After login, the user is redirected to `/dashboard`.

## Important Routes

Application routes are stored in:

```text
routes/web.php
routes/settings.php
```

Common routes:

| URL | Name | Description |
| --- | --- | --- |
| `/` | `home` | Home page |
| `/dashboard` | `dashboard` | Protected dashboard |
| `/settings/profile` | `profile.edit` | User profile settings |
| `/settings/appearance` | `appearance.edit` | Appearance settings |
| `/settings/security` | `security.edit` | Security settings |

List all routes:

```bash
php artisan route:list
```

Filter auth routes:

```bash
php artisan route:list --path=login
php artisan route:list --path=register
```

## Testing

Run the test suite:

```bash
php artisan test --compact
```

Run only auth tests:

```bash
php artisan test --compact tests/Feature/Auth
```

Format PHP code with Laravel Pint:

```bash
vendor/bin/pint --dirty --format agent
```

## Build

Build production assets:

```bash
npm run build
```

## Project Notes

- Dashboard view: `resources/views/dashboard.blade.php`
- Login credential field: `username`
- Email is still used for registration, email verification, and password reset.
- The `users.username` column is unique and added by `2026_07_24_203402_add_username_to_users_table.php`.
