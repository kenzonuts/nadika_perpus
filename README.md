# Nadika Perpus

Smart Secure Library Management System — Enterprise Laravel backend + Blade + Tailwind + Alpine.js.

## Stack

- Laravel 11 (PHP 8.3 — upgrade ke Laravel 12 butuh PHP 8.4)
- PostgreSQL (Supabase)
- Spatie Permission + Activitylog
- Laravel Sanctum, Maatwebsite Excel
- Service → Repository → Model architecture

## Requirements

```bash
sudo apt install php8.3-xml php8.3-pgsql php8.3-mbstring php8.3-zip php8.3-curl
```

Atau gunakan `./artisan-dev` (bundled extensions di `.php/extensions/`).

## Setup

### 1. Environment

```bash
cp .env.example .env
# Isi DB_* dengan kredensial Supabase PostgreSQL
# Atau pakai Docker lokal:
docker compose up -d
# Lalu di .env: DB_HOST=127.0.0.1 DB_PORT=5433 DB_DATABASE=nadika DB_USERNAME=nadika DB_PASSWORD=nadika DB_SSLMODE=prefer
```

### 2. Database

```bash
./artisan-dev migrate:fresh --seed
```

### 3. Run

```bash
# Terminal 1
npm run dev

# Terminal 2
./artisan-dev serve
```

Buka **http://localhost:8000**

## Default accounts (after seed)

| Role | Email | Password |
|------|-------|----------|
| Super Admin | admin@library.local | Password123! |
| Librarian | librarian@library.local | Password123! |
| Member | member@library.local | Password123! |

## Architecture

```
app/
├── Actions/          DTO/              Enums/
├── Events/           Exceptions/       Helpers/
├── Http/Controllers/ Http/Requests/    Http/Middleware/
├── Jobs/             Listeners/        Models/
├── Observers/        Policies/         Repositories/
├── Services/         ViewModels/       Support/
```

## Docs

Lihat [`doc.md`](doc.md) untuk master plan dan [`docs/`](docs/) untuk prompt per fase.

## API

Health check: `GET /api/v1/health`
