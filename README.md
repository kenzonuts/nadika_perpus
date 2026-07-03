# Nadika Perpus

**Smart Secure Library Management System** — sistem manajemen perpustakaan berbasis web dengan arsitektur enterprise Laravel, frontend Blade + Tailwind CSS + Alpine.js, dan database PostgreSQL (Supabase).

Aplikasi ini mencakup manajemen buku, kategori, anggota, transaksi peminjaman & pengembalian, denda, dashboard analitik, laporan, audit log, serta pengaturan perpustakaan dengan kontrol akses berbasis role.

---

## Daftar Isi

- [Fitur Utama](#fitur-utama)
- [Tech Stack](#tech-stack)
- [Arsitektur](#arsitektur)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi & Setup](#instalasi--setup)
- [Menjalankan Aplikasi](#menjalankan-aplikasi)
- [Akun Default](#akun-default)
- [Struktur Project](#struktur-project)
- [Modul & Routes](#modul--routes)
- [Role & Permission](#role--permission)
- [Database](#database)
- [Konfigurasi Environment](#konfigurasi-environment)
- [Development Workflow](#development-workflow)
- [Testing & Code Style](#testing--code-style)
- [API](#api)
- [Dokumentasi Lengkap](#dokumentasi-lengkap)
- [Contributing](#contributing)

---

## Fitur Utama

| Modul | Deskripsi |
|-------|-----------|
| **Landing Page** | Halaman publik dengan statistik perpustakaan dan buku populer |
| **Autentikasi** | Login, register, reset password, verifikasi email (Laravel Breeze) |
| **Dashboard** | Statistik real-time, aktivitas terbaru, notifikasi |
| **Buku** | CRUD buku, upload cover, soft delete & trash, import CSV/Excel |
| **Kategori** | CRUD kategori buku dengan slug |
| **Anggota** | CRUD anggota perpustakaan, terhubung ke akun user |
| **Peminjaman** | Buat peminjaman, riwayat, status overdue otomatis |
| **Pengembalian** | Proses pengembalian per item, kondisi buku (good/damaged/lost) |
| **Denda** | Denda keterlambatan per item peminjaman |
| **Laporan** | Laporan buku, anggota, peminjaman, dan denda |
| **Audit Log** | Jejak aktivitas sistem via Spatie Activitylog |
| **Profil** | Update profil, keamanan, riwayat aktivitas user |
| **Pengaturan** | Konfigurasi umum, perpustakaan, keamanan, notifikasi, sistem |

---

## Tech Stack

| Komponen | Versi / Tool |
|----------|--------------|
| **Framework** | Laravel 11 (PHP 8.3+) |
| **Frontend** | Blade, Tailwind CSS 4, Alpine.js 3, Vite 6 |
| **Database** | PostgreSQL — Supabase (production) atau Docker lokal |
| **Storage** | Supabase Storage (S3-compatible) / local disk |
| **Auth** | Laravel Breeze + Spatie Laravel Permission |
| **Activity Log** | Spatie Laravel Activitylog |
| **Import** | Maatwebsite Excel |
| **API** | Laravel Sanctum (health check tersedia) |
| **Code Style** | Laravel Pint |

> **Catatan:** Database **hanya PostgreSQL**. SQLite dan MySQL tidak didukung.

---

## Arsitektur

Project mengikuti pola **layered architecture** dengan pemisahan tanggung jawab yang ketat:

```
HTTP Request
    ↓
Controller          ← orchestration saja (tanpa business logic)
    ↓
Form Request        ← validasi input
Policy              ← otorisasi akses
    ↓
Service             ← business logic (satu-satunya tempat)
    ↓
Repository          ← query & persistence abstraction
    ↓
Eloquent Model      ← BaseModel (UUID + Soft Delete)
    ↓
ViewModel (web)     ← format data untuk Blade
API Resource (API)  ← format data untuk JSON
```

### Aturan Penting

- Business logic **hanya** di `app/Services/`
- Controller **hanya** memanggil Service dan mengembalikan View/Redirect
- Validasi **hanya** di `app/Http/Requests/`
- Web view **wajib** pakai ViewModel — jangan kirim Model mentah ke Blade
- `User` extends `Authenticatable` (bukan `BaseModel`), dengan trait `HasUuid`
- Frontend Blade **sudah selesai** — jangan ubah `resources/views/` kecuali integrasi variable
- Detail mapping variable Blade → lihat [`docs/FE-CONTRACT.md`](docs/FE-CONTRACT.md)

---

## Persyaratan Sistem

### Software

- **PHP** 8.3 atau lebih baru
- **Composer** 2.x
- **Node.js** 18+ dan **npm**
- **PostgreSQL** 16 (via Supabase atau Docker)
- **Git**

### PHP Extensions (wajib)

```bash
sudo apt install php8.3-cli php8.3-xml php8.3-pgsql php8.3-mbstring \
  php8.3-zip php8.3-curl php8.3-bcmath php8.3-intl php8.3-redis
```

> Extension `pdo_pgsql` wajib untuk koneksi PostgreSQL/Supabase.

Project ini menyediakan wrapper `./artisan-dev` yang memuat konfigurasi PHP tambahan dari `.php/conf.d/` (misalnya `xml`) jika extension sistem belum terpasang.

---

## Instalasi & Setup

### 1. Clone Repository

```bash
git clone <url-repository> nadika
cd nadika
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` sesuai environment kamu. Ada dua opsi database:

#### Opsi A — PostgreSQL Lokal (Docker) — direkomendasikan untuk development

```bash
docker compose up -d
```

Lalu set di `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5433
DB_DATABASE=nadika
DB_USERNAME=nadika
DB_PASSWORD=nadika
DB_SSLMODE=prefer
```

#### Opsi B — Supabase (production / staging)

```env
DB_CONNECTION=pgsql
DB_HOST=db.xxxxxxxxxxxx.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=<password-supabase>
DB_SSLMODE=require
```

Untuk Supabase Storage (upload cover buku), isi juga:

```env
FILESYSTEM_DISK=supabase
SUPABASE_URL=https://xxxxxxxxxxxx.supabase.co
SUPABASE_STORAGE_BUCKET=library-assets
AWS_ACCESS_KEY_ID=<supabase-storage-key>
AWS_SECRET_ACCESS_KEY=<supabase-storage-secret>
AWS_DEFAULT_REGION=ap-southeast-1
AWS_BUCKET=library-assets
AWS_ENDPOINT=https://xxxxxxxxxxxx.supabase.co/storage/v1/s3
AWS_USE_PATH_STYLE_ENDPOINT=true
```

### 4. Database Migration & Seed

```bash
./artisan-dev migrate:fresh --seed
```

Perintah ini akan:

- Membuat semua tabel (users, books, borrowings, dll.)
- Menjalankan seeder role & permission
- Membuat akun default (admin, librarian, member)
- Mengisi data sample (kategori, rak, buku, anggota, pengaturan)

---

## Menjalankan Aplikasi

Butuh **dua terminal** berjalan bersamaan:

```bash
# Terminal 1 — Vite dev server (CSS/JS hot reload)
npm run dev

# Terminal 2 — Laravel development server
./artisan-dev serve
```

Buka browser: **http://localhost:8000**

### Alternatif: Composer Dev Script

Jalankan server, queue, log, dan Vite sekaligus:

```bash
composer dev
```

> Membutuhkan PHP extensions lengkap di sistem (bukan hanya via `artisan-dev`).

---

## Akun Default

Setelah `migrate:fresh --seed`, gunakan akun berikut:

| Role | Email | Password | Akses |
|------|-------|----------|-------|
| Super Admin | `admin@library.local` | `Password123!` | Semua permission |
| Librarian | `librarian@library.local` | `Password123!` | Semua kecuali `users.manage` |
| Member | `member@library.local` | `Password123!` | Lihat buku, peminjaman, pengembalian |

> **Peringatan:** Ganti password default sebelum deploy ke production.

---

## Struktur Project

```
nadika/
├── app/
│   ├── Enums/              # Enum status (BorrowingStatus, FineStatus, dll.)
│   ├── Events/             # Domain events (BookCreated, BookBorrowed, dll.)
│   ├── Exceptions/         # Custom exceptions
│   ├── Helpers/            # Helper functions
│   ├── Http/
│   │   ├── Controllers/    # Web & Auth controllers
│   │   ├── Middleware/     # Custom middleware (EnsureUserIsActive, dll.)
│   │   └── Requests/       # Form Request validation
│   ├── Jobs/               # Queue jobs (ProcessBookImportJob)
│   ├── Listeners/          # Event listeners
│   ├── Models/             # Eloquent models (BaseModel + User)
│   ├── Observers/          # Model observers
│   ├── Policies/           # Authorization policies
│   ├── Repositories/       # Repository pattern (Contracts + Eloquent)
│   ├── Services/           # Business logic layer
│   ├── Support/            # Shared concerns
│   ├── Traits/             # Reusable traits (ApiResponds)
│   ├── View/Composers/     # View composers
│   └── ViewModels/         # Data formatting untuk Blade
├── config/
│   └── library.php         # Default konfigurasi perpustakaan
├── database/
│   ├── factories/          # Model factories
│   ├── migrations/         # Database migrations
│   └── seeders/            # Database seeders
├── docs/                   # Dokumentasi development per fase
├── resources/
│   ├── css/                # Tailwind entry
│   ├── js/                 # Alpine.js entry
│   └── views/              # Blade templates (JANGAN UBAH struktur)
├── routes/
│   ├── web.php             # Web routes
│   ├── api.php             # API routes
│   └── auth.php            # Auth routes (Breeze)
├── tests/                  # PHPUnit tests
├── artisan-dev             # Wrapper artisan dengan PHP config tambahan
├── docker-compose.yml      # PostgreSQL lokal
├── doc.md                  # Master development plan
└── .env.example            # Template environment
```

---

## Modul & Routes

### Halaman Publik

| URL | Route Name | Keterangan |
|-----|------------|------------|
| `/` | — | Landing page |
| `/login` | `login` | Halaman login |
| `/register` | `register` | Registrasi user baru |
| `/forgot-password` | `password.request` | Lupa password |

### Halaman Terautentikasi

| URL | Route Name | Controller |
|-----|------------|------------|
| `/dashboard` | `dashboard` | DashboardController |
| `/books` | `books.*` | BookController |
| `/books/import` | `books.import` | BookImportController |
| `/books/trash` | `books.trash` | BookController |
| `/categories` | `categories.*` | CategoryController |
| `/members` | `members.*` | MemberController |
| `/borrowings` | `borrowings.*` | BorrowingController |
| `/borrowings/history` | `borrowings.history` | BorrowingController |
| `/returns` | `returns.*` | BookReturnController |
| `/reports` | `reports.*` | ReportController |
| `/audit` | `audit.*` | AuditController |
| `/profile` | `profile.*` | ProfileController |
| `/settings/general` | `settings.general` | SettingsController |
| `/settings/library` | `settings.library` | SettingsController |
| `/settings/security` | `settings.security` | SettingsController |
| `/settings/notifications` | `settings.notifications` | SettingsController |
| `/settings/system` | `settings.system` | SettingsController |

Semua route di atas (kecuali publik) dilindungi middleware `auth` + `verified`.

---

## Role & Permission

Menggunakan **Spatie Laravel Permission** dengan 3 role:

### Roles

| Role | Slug | Deskripsi |
|------|------|-----------|
| Super Admin | `super-admin` | Akses penuh termasuk manajemen user |
| Librarian | `librarian` | Operasional perpustakaan (tanpa `users.manage`) |
| Member | `member` | Hanya lihat buku, peminjaman, dan pengembalian |

### Permissions

```
books.view | books.create | books.update | books.delete
categories.view | categories.create | categories.update | categories.delete
members.view | members.create | members.update | members.delete
borrowings.view | borrowings.create | borrowings.update | borrowings.delete
returns.view | returns.create
fines.view | fines.manage
reports.view | reports.export
audit.view
settings.view | settings.update
users.manage
```

Permission dicek via Policy di controller dan `@can` di Blade.

---

## Database

### Tabel Utama

| Tabel | Keterangan |
|-------|------------|
| `users` | Akun pengguna (UUID, soft delete) |
| `categories` | Kategori buku |
| `shelves` | Rak penyimpanan |
| `books` | Data buku (`publication_status`, `available_stock`) |
| `book_images` | Gambar buku (multiple per buku) |
| `members` | Data anggota perpustakaan |
| `borrowings` | Header transaksi peminjaman |
| `borrowing_items` | Item buku per peminjaman |
| `book_returns` | Header pengembalian |
| `return_items` | Item pengembalian per `borrowing_item` |
| `fines` | Denda per `borrowing_item` |
| `system_settings` | Pengaturan runtime (override `config/library.php`) |
| `activity_log` | Audit trail (Spatie) |
| `roles`, `permissions`, `model_has_*` | RBAC (Spatie) |

Semua tabel domain menggunakan **UUID** sebagai primary key dan **soft delete** where applicable.

### Enum Values

```
BookPublicationStatus: published | draft | archived
MemberStatus:          active | inactive | suspended
BorrowingStatus:       pending | active | returned | cancelled | overdue
BorrowingItemStatus:   borrowed | returned | overdue
BookReturnCondition:   good | damaged | lost
FineStatus:            unpaid | paid | waived
Gender:                male | female | other
```

---

## Konfigurasi Environment

### Variabel Penting

| Variabel | Default | Keterangan |
|----------|---------|------------|
| `APP_NAME` | `Nadika Perpus` | Nama aplikasi |
| `APP_TIMEZONE` | `Asia/Jakarta` | Timezone |
| `DB_CONNECTION` | `pgsql` | Wajib PostgreSQL |
| `FILESYSTEM_DISK` | `local` / `supabase` | Storage driver |
| `QUEUE_CONNECTION` | `database` | Queue driver |
| `CACHE_STORE` | `database` | Cache driver |
| `SESSION_DRIVER` | `database` | Session driver |
| `LIBRARY_BORROW_LIMIT` | `3` | Maks buku dipinjam per anggota |
| `LIBRARY_LOAN_DURATION` | `14` | Durasi pinjam (hari) |
| `LIBRARY_FINE_PER_DAY` | `5000` | Denda per hari (IDR) |
| `LIBRARY_MAX_UPLOAD_KB` | `2048` | Maks ukuran upload gambar (KB) |

Nilai `LIBRARY_*` bisa di-override oleh tabel `system_settings` saat runtime.

---

## Development Workflow

### Perintah yang Sering Dipakai

```bash
# Migration
./artisan-dev migrate
./artisan-dev migrate:fresh --seed

# Cache
./artisan-dev config:clear
./artisan-dev cache:clear
./artisan-dev view:clear

# Queue (jika pakai import buku async)
./artisan-dev queue:work

# Code style
./vendor/bin/pint

# Route list
./artisan-dev route:list
```

### Aturan Kontribusi Kode

1. **Jangan ubah** `resources/views/` kecuali untuk integrasi variable dari ViewModel
2. Business logic **hanya** di `app/Services/`
3. Setiap endpoint web baru **wajib** punya ViewModel
4. Validasi **wajib** di Form Request, bukan di controller
5. Gunakan Policy untuk otorisasi, bukan pengecekan role manual di controller
6. Ikuti konvensi penamaan existing (Service, Repository, ViewModel)
7. Commit message jelas — fokus pada **why**, bukan hanya what

### Urutan Development (Fase)

Project dikembangkan bertahap. Lihat [`doc.md`](doc.md) untuk master plan dan [`docs/`](docs/) untuk detail per fase:

| Fase | File | Fokus |
|------|------|-------|
| 0 | `docs/00-prerequisites.md` | Environment & Supabase setup |
| 1 | `docs/01-foundation.md` | Arsitektur dasar |
| 2 | `docs/02-database.md` | Migrations & models |
| 3 | `docs/03-auth.md` | Autentikasi & RBAC |
| 4 | `docs/04-master-data.md` | Buku, kategori, anggota |
| 5 | `docs/05-transactions.md` | Peminjaman, pengembalian, denda |
| 6 | `docs/06-dashboard-reports.md` | Dashboard & laporan |
| 7 | `docs/07-settings-profile.md` | Pengaturan & profil |
| 8 | `docs/08-book-import.md` | Import buku bulk |
| 9 | `docs/09-frontend-integration.md` | Integrasi Blade dengan backend |

---

## Testing & Code Style

### Menjalankan Tests

```bash
./artisan-dev test
# atau
./vendor/bin/phpunit
```

### Code Style (Laravel Pint)

```bash
./vendor/bin/pint              # fix semua file
./vendor/bin/pint --test       # cek tanpa mengubah
```

---

## API

API masih dalam tahap awal. Endpoint yang tersedia:

```
GET /api/v1/health    → { "success": true, "message": "API is running" }
```

Autentikasi API (Sanctum) akan ditambahkan di fase berikutnya.

---

## Dokumentasi Lengkap

| File | Isi |
|------|-----|
| [`doc.md`](doc.md) | Master plan, arsitektur, checklist progress, enum & tabel final |
| [`docs/FE-CONTRACT.md`](docs/FE-CONTRACT.md) | Mapping variable Blade ↔ Model (WAJIB dibaca sebelum integrasi) |
| [`docs/00-prerequisites.md`](docs/00-prerequisites.md) | Setup environment production-ready |
| [`docs/01-foundation.md`](docs/01-foundation.md) | Fondasi arsitektur enterprise |
| [`docs/02-database.md`](docs/02-database.md) | Database design & migrations |
| [`docs/03-auth.md`](docs/03-auth.md) | Auth + Spatie Permission |
| [`docs/04-master-data.md`](docs/04-master-data.md) | Modul master data |
| [`docs/05-transactions.md`](docs/05-transactions.md) | Modul transaksi |
| [`docs/06-dashboard-reports.md`](docs/06-dashboard-reports.md) | Dashboard & laporan |
| [`docs/07-settings-profile.md`](docs/07-settings-profile.md) | Settings & profil |
| [`docs/08-book-import.md`](docs/08-book-import.md) | Import buku CSV/Excel |
| [`docs/09-frontend-integration.md`](docs/09-frontend-integration.md) | Integrasi frontend |

---

## Contributing

### Quick Start untuk Contributor Baru

1. Clone repo & ikuti [Instalasi & Setup](#instalasi--setup)
2. Baca [`doc.md`](doc.md) untuk memahami arsitektur
3. Baca [`docs/FE-CONTRACT.md`](docs/FE-CONTRACT.md) sebelum menyentuh integrasi view
4. Buat branch dari `main` dengan nama deskriptif: `feat/book-export`, `fix/borrowing-overdue`
5. Pastikan `./vendor/bin/pint` bersih sebelum commit
6. Push branch & buat Pull Request dengan deskripsi jelas

### Hal yang Perlu Diperhatikan

- **Jangan commit** file `.env` — hanya `.env.example`
- **Jangan ubah** struktur Blade yang sudah ada
- Data di view sekarang berasal dari **database real** (bukan sample-data hardcoded)
- Gunakan `./artisan-dev` jika PHP extension sistem belum lengkap
- Database wajib PostgreSQL — jangan pakai SQLite/MySQL

---

## License

Project ini menggunakan [MIT License](https://opensource.org/licenses/MIT).
