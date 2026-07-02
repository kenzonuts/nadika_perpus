# Nadika Perpus

Smart Secure Library Management System — Laravel 11 + Blade + Tailwind CSS + Alpine.js.

## Requirements

- PHP 8.3+
- Composer
- Node.js 18+
- PHP extensions: `xml`, `mbstring`, `curl`, `zip`, `pdo` (recommended: `php8.3-xml`, `php8.3-sqlite3`)

## Setup

```bash
# Install PHP dependencies (already included if vendor/ exists)
composer install

# Environment
cp .env.example .env
php artisan key:generate   # or use ./artisan-dev key:generate

# Frontend
npm install
npm run dev

# Laravel server (terminal terpisah)
./artisan-dev serve
```

Buka aplikasi di **http://localhost:8000** (bukan port 5173 — itu hanya Vite).

## PHP XML extension

Jika `php artisan` error `Class "DOMDocument" not found`, install ekstensi XML:

```bash
sudo apt install php8.3-xml php8.3-sqlite3
```

Atau gunakan wrapper `./artisan-dev` yang sudah memuat ekstensi dari `.php/extensions/`.

## Development

Jalankan **dua terminal** bersamaan:

| Terminal | Perintah | URL |
|----------|----------|-----|
| 1 | `npm run dev` | Vite HMR (port 5173) |
| 2 | `./artisan-dev serve` | Laravel app (port 8000) |

## Project structure

- `resources/views/` — Blade templates (UI sudah jadi, masih dummy data)
- `routes/web.php` — Route definitions (`Route::view` sementara)
- `app/` — Controllers, Models (belum diisi — langkah berikutnya: backend)
