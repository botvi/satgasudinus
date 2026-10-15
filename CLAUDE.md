# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

Satgas PPKS UDINUS: a Laravel 9 (PHP ^8.0.2, MySQL) site with a public information portal and an admin panel for managing activities, documents, gallery, and harassment reports ("lapor"). UI language is Indonesian. `README.md` is the stock Laravel one; `appsatgas_db.sql` is a DB dump to import for a local DB (there are no migrations for the app tables).

## Commands

- `composer install`, then copy `.env.example` to `.env`, run `php artisan key:generate`, set DB creds, and import `appsatgas_db.sql`
- `php artisan serve`: run the app
- `php artisan test` (or `vendor/bin/phpunit --filter TestName`): tests; only the default example tests exist
- `vendor/bin/pint`: code style
- `npm run dev` / `npm run build`: Vite, but views do not use it (see below)

## Architecture

Classic Laravel MVC, with all routes in [routes/web.php](routes/web.php) (no API routes in use).

- **Public site**: `Web*Controller`s plus `HomeController`, rendered from `resources/views/pageweb/*` with layout `template-web/`. Routes are under `/` and `/satgas/*` (kegiatan, galeri, lapor, dokumen, pengantar, filosofi, lainnya). `POST /satgas/lapor` is the public report submission.
- **Admin panel**: login at `/kelolasatgas` (named route `login`, handled by `LoginController`). Everything else sits in the `auth` middleware group: `DashboardController`, and resource-style CRUD written out by hand (no `Route::resource`) for `kegiatans`, `dokumens`, `galeris`, `lapor`, using views in `resources/views/pageadmin/*` with layout `template-admin/`.
- **Models** (`app/Models`): `Kegiatan`, `Dokumen`, `Galeri`, `Lapor`, `User`. Flat Eloquent models with `$fillable`.
- **Report PIN gate**: `/lapor` index uses the `always.verify.admin.password` middleware ([AlwaysVerifyAdminPassword](app/Http/Middleware/AlwaysVerifyAdminPassword.php)). It requires a `pin_verified` session flag, which is consumed on each request, so the admin must re-enter their PIN every time. [AdminPasswordController](app/Http/Controllers/AdminPasswordController.php) handles verify and change-PIN. The PIN is stored as plain text in `users.pin` and compared directly, not hashed. Note the other `lapor/{id}` routes are not behind the PIN gate.
- **PDF export**: `LaporController::download` renders `pageadmin.lapor.pdf` via barryvdh/laravel-dompdf. Alerts use realrashid/sweet-alert.
- **Uploads** are stored directly under `public/` subfolders (`identitas`, `buktitindakan`, `dokumen`, `galeri`, `kegiatan`), not `storage/`.
- **Frontend assets**: served statically from `public/admin` and `public/web` via `asset('web')`, `asset('admin')`, `asset('env')`. Vite and Mix are not wired into the Blade templates. `public/web-new/` is an untracked static HTML redesign draft and is not served by any route.
