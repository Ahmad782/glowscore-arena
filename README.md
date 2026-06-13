# GlowScore Arena

A Laravel + Bootstrap + Chart.js student performance portal with a gaming-style leaderboard, XP score, attendance, marks, boosts and penalties.

## Fresh setup

```powershell
composer install
copy .env.example .env
mkdir bootstrap\cache
mkdir storage\framework\views
mkdir storage\framework\cache
mkdir storage\framework\sessions
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

Open:

```text
http://127.0.0.1:8000
```

## Recommended local database

For easiest setup, use SQLite in `.env`:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

Then create the file:

```powershell
type nul > database\database.sqlite
php artisan migrate:fresh --seed
```

## MySQL note

If using old MySQL/MariaDB, roll_no is limited to 50 chars to avoid index length errors.
