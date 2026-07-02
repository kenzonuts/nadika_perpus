# Fase 0 — Prerequisites

## Prerequisites

- Frontend selesai (jangan ubah `resources/views/` kecuali diminta)
- Laravel 11 terpasang di project
- Node.js + `npm run dev` berjalan

## Objective

Siapkan environment production-ready sebelum fondasi arsitektur.

## Tasks

### 1. PHP Extensions

Install (wajib):

```bash
sudo apt install php8.3-xml php8.3-pgsql php8.3-sqlite3 php8.3-redis
```

> `pdo_pgsql` wajib untuk Supabase PostgreSQL.

### 2. Upgrade Laravel 12

```bash
composer require laravel/framework:^12.0
composer update
```

PHP 8.3 didukung Laravel 12. Jangan upgrade ke Laravel 13 (butuh PHP 8.4).

### 3. Environment — PostgreSQL Supabase

Update `.env.example` dan `.env`:

```env
APP_NAME="Nadika Perpus"
APP_URL=http://localhost:8000

DB_CONNECTION=pgsql
DB_HOST=db.xxxxxxxxxxxx.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=
DB_SSLMODE=require

# Connection pooler (production)
DB_POOL_HOST=aws-0-region.pooler.supabase.com
DB_POOL_PORT=6543

# Supabase Storage
SUPABASE_URL=https://xxxxxxxxxxxx.supabase.co
SUPABASE_STORAGE_BUCKET=library-assets
SUPABASE_STORAGE_KEY=
SUPABASE_STORAGE_SECRET=
SUPABASE_STORAGE_ENDPOINT=https://xxxxxxxxxxxx.supabase.co/storage/v1/s3
SUPABASE_STORAGE_REGION=ap-southeast-1

FILESYSTEM_DISK=supabase
QUEUE_CONNECTION=database
CACHE_STORE=database
SESSION_DRIVER=database
```

**Dilarang:** `DB_CONNECTION=sqlite`, `mysql`.

### 4. Config Database

Di `config/database.php`:

- Connection `pgsql` dengan `sslmode` => `require`
- Connection `pgsql_pool` untuk pooler (port 6543) — siapkan, dokumentasikan di comment

### 5. Hapus SQLite Artifacts

- Hapus referensi sqlite dari `.env.example`
- Hapus `database/database.sqlite` jika ada
- Update `composer.json` post-create script (hapus touch sqlite)

## Output

- [ ] Laravel 12 running (`php artisan --version`)
- [ ] `.env.example` PostgreSQL-only
- [ ] PHP extensions terpasang
- [ ] `config/database.php` Supabase-ready

## Do NOT

- Jangan buat migration
- Jangan buat model/controller
- Jangan ubah file Blade
- Jangan install Breeze di fase ini
