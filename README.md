# BusinessEx

BusinessEx is a Laravel 12 application for business, investor, startup, mentor, lender, and service workflows.

## Implemented hardening

The current implementation includes the following security and production-readiness improvements:

- Google, Facebook, and LinkedIn OAuth through `SocialLoginController`.
- Social accounts are linked to the existing `user_account` table by provider ID or verified provider email.
- Public authentication, registration, password-reset, newsletter, contact, and payment-initiation endpoints use named rate limiters.
- Rate-limit keys combine the client IP with the submitted email where appropriate, limiting password abuse while avoiding one shared global bucket.
- Profile registration flows use the authenticated account ID and ignore client-supplied foreign `user_id` values.
- Removed the client-controlled payment price override.
- All normal form submissions continue to use Laravel CSRF protection.
- OAuth failures are logged server-side and shown to users with a generic message.

## Local setup

1. Install PHP dependencies with `composer install`.
2. Copy `.env.example` to `.env` and run `C:\xampp\php\php.exe artisan key:generate`.
3. Configure the database, mailer, session, cache, and queue values in `.env`.
4. Run `C:\xampp\php\php.exe artisan migrate`.
5. Build frontend assets with `npm install` followed by `npm run build`.

## Social OAuth configuration

Set these values in `.env`:

```dotenv
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"
FACEBOOK_CLIENT_ID=
FACEBOOK_CLIENT_SECRET=
FACEBOOK_REDIRECT_URI="${APP_URL}/auth/facebook/callback"
LINKEDIN_CLIENT_ID=
LINKEDIN_CLIENT_SECRET=
LINKEDIN_REDIRECT_URI="${APP_URL}/auth/linkedin/callback"
```

Register each callback URL in its provider's developer console. Production OAuth callback URLs must use HTTPS and exactly match the configured application URL.

## Production checklist

- Set `APP_ENV=production`, `APP_DEBUG=false`, and a real HTTPS `APP_URL`.
- Set `SESSION_SECURE_COOKIE=true`, use a shared session store, and use Redis or another shared cache for multi-instance deployments.
- Use a managed MySQL-compatible database with a restricted application user, encrypted transport where supported, and regular backups.
- Set a real mail driver and run queue workers for email delivery rather than using the `log` mailer in production.
- Keep OAuth, payment, and application secrets outside source control; rotate any exposed credentials.
- Store confidential uploads on a private disk and serve them through authorization-controlled download endpoints.
- Put the application behind HTTPS, a reverse proxy/WAF, and a process supervisor; enable PHP OPcache and monitor queue, database, and error metrics.

## Verification

Run the test suite with:

```powershell
C:\xampp\php\php.exe artisan test
```

The repository also contains workflow and integration notes in `TEST_CASES.md` and `INTEGRATION_CHECKLIST.md`.

---

The framework documentation below is retained for Laravel-specific reference.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Application Tests

The application workflow test matrix, validation cases, manual integration coverage, and Windows execution commands are documented in [TEST_CASES.md](TEST_CASES.md).

Run the full PHPUnit suite on this XAMPP installation with:

```powershell
C:\xampp\php\php.exe artisan test
```

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
