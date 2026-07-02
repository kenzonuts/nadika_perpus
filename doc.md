# Smart Secure Library Management System — Backend Plan

> Production-ready enterprise Laravel backend plan.  
> Frontend sudah selesai — **jangan ubah Blade** kecuali integrasi variable.

---

## Status Proyek Saat Ini

| Layer | Status |
|-------|--------|
| Frontend (Blade + Tailwind + Alpine) | ✅ Selesai |
| Laravel setup (v11, perlu upgrade ke 12) | ✅ Dasar |
| Enterprise architecture | ❌ Belum |
| Database & models | ❌ Belum |
| Auth & modules | ❌ Belum |

---

## Tech Stack

| Komponen | Versi / Tool |
|----------|--------------|
| Laravel | 12 |
| PHP | 8.3+ |
| Database | PostgreSQL (Supabase only) |
| Storage | Supabase Storage (S3-compatible) |
| Auth | Laravel Breeze + Spatie Permission |
| Activity Log | Spatie Activitylog |
| API (future) | Laravel Sanctum |
| Testing | PestPHP |
| Code style | Laravel Pint |

**Dilarang:** SQLite, MySQL.

---

## Arsitektur

```
Request → Controller → Service → Repository → Eloquent (BaseModel)
                ↓
         Form Request (validasi)
         Policy (otorisasi)
         ViewModel (data ke Blade)
         API Resource (data ke API)
```

**Aturan:**
- Business logic **hanya** di Service
- Controller **hanya** orchestration
- Validasi **hanya** di Form Request
- Web pakai **ViewModel**, API pakai **Resource**
- `User` extends `Authenticatable` (bukan `BaseModel`)

---

## Urutan Eksekusi (10 Fase)

| Fase | File Prompt | Fokus | Estimasi |
|------|-------------|-------|----------|
| 0 | [docs/00-prerequisites.md](docs/00-prerequisites.md) | Upgrade Laravel 12, PHP ext, Supabase env | 1 sesi |
| 1 | [docs/01-foundation.md](docs/01-foundation.md) | Folder, BaseModel, abstractions | 1 sesi |
| 2 | [docs/02-database.md](docs/02-database.md) | Migrations, models, factories, seeders | 1–2 sesi |
| 3 | [docs/03-auth.md](docs/03-auth.md) | Breeze + Spatie, tanpa timpa views | 1–2 sesi |
| 4 | [docs/04-master-data.md](docs/04-master-data.md) | Books, Categories, Shelves, Members | 2–3 sesi |
| 5 | [docs/05-transactions.md](docs/05-transactions.md) | Borrow, Return, Fine, inventory | 2–3 sesi |
| 6 | [docs/06-dashboard-reports.md](docs/06-dashboard-reports.md) | Dashboard, analytics, reports, audit | 2 sesi |
| 7 | [docs/07-settings-profile.md](docs/07-settings-profile.md) | Settings + profile backend | 1 sesi |
| 8 | [docs/08-book-import.md](docs/08-book-import.md) | CSV/Excel bulk import | 1 sesi |
| 9 | [docs/09-frontend-integration.md](docs/09-frontend-integration.md) | Wire routes ke controller, ViewModels | 1–2 sesi |

**Cara pakai:** Buka file fase → copy seluruh isi → paste ke Agent mode → tunggu selesai → lanjut fase berikutnya.

---

## Koreksi dari Draft Awal

Perbaikan yang sudah diterapkan di plan ini:

| # | Masalah | Solusi |
|---|---------|--------|
| 1 | `BookStatus` AVAILABLE/BORROWED bentrok FE | Pisah: `BookPublicationStatus` (published/draft/archived) + `available_stock` |
| 2 | Tabel `roles`, `permissions`, `activity_logs` duplikat Spatie | Pakai migration Spatie saja (`activity_log`, permission tables) |
| 3 | Tabel `returns` reserved word | Rename → `book_returns` + `return_items` |
| 4 | Return/fine level tidak jelas | Return & fine per `borrowing_item`, bukan per header saja |
| 5 | Breeze timpa auth views | Install Breeze, render view existing (`auth.login`, dll.) |
| 6 | `User` extend `BaseModel` | `User` extends `Authenticatable` + trait `HasUuid` |
| 7 | Settings, import, 2FA tidak ada | Fase 7, 8 ditambahkan |
| 8 | Tidak ada fase integrasi FE | Fase 9 + [docs/FE-CONTRACT.md](docs/FE-CONTRACT.md) |
| 9 | `publication_year` vs FE `year` | Accessor `getYearAttribute()` → alias `year` |
| 10 | `available_stock` vs FE `available` | Accessor `getAvailableAttribute()` |
| 11 | `config/library.php` vs `system_settings` | Config = default, DB = runtime (DB override config) |
| 12 | ViewModels/DTO tidak dipakai | ViewModel wajib untuk web, DTO untuk service layer |

---

## Enum Definitions (Final)

```php
BookPublicationStatus: published | draft | archived
MemberStatus:          active | inactive | suspended
BorrowingStatus:       pending | active | returned | cancelled | overdue
BorrowingItemStatus:   borrowed | returned | overdue
BookReturnCondition:   good | damaged | lost
FineStatus:            unpaid | paid | waived
Gender:                male | female | other
NotificationType:      borrow | return | overdue | fine | system | security
```

> Role user pakai **Spatie Permission** (`super-admin`, `librarian`, `member`) — bukan enum terpisah.

---

## Database Tables (Final)

| Tabel | Catatan |
|-------|---------|
| `users` | UUID, soft delete |
| Spatie: `roles`, `permissions`, `model_has_*` | Via vendor publish |
| Spatie: `activity_log` | Bukan tabel custom |
| `categories` | UUID, slug, soft delete |
| `shelves` | UUID, soft delete |
| `books` | UUID, `publication_status`, `available_stock`, soft delete |
| `book_images` | UUID, `book_id`, `path`, `is_primary`, `sort_order` |
| `members` | UUID, `user_id` nullable, soft delete |
| `borrowings` | UUID, header transaksi |
| `borrowing_items` | UUID, per buku |
| `book_returns` | UUID, header pengembalian |
| `return_items` | UUID, per `borrowing_item` |
| `fines` | UUID, per `borrowing_item` |
| `notifications` | Laravel default |
| `system_settings` | Key-value atau single row |

---

## Frontend Routes → Backend Mapping

| Route | Controller (nanti) | View |
|-------|-------------------|------|
| `/` | `LandingController@index` | `landing.index` |
| `/login` … `/two-factor` | Breeze controllers | `auth.*` |
| `/dashboard` | `DashboardController@index` | `dashboard.index` |
| `/books/*` | `BookController` | `books.*` |
| `/categories/*` | `CategoryController` | `categories.*` |
| `/members/*` | `MemberController` | `members.*` |
| `/borrowings/*` | `BorrowingController` | `borrowings.*` |
| `/returns/*` | `BookReturnController` | `returns.*` |
| `/reports/*` | `ReportController` | `reports.*` |
| `/audit/*` | `AuditController` | `audit.*` |
| `/profile/*` | `ProfileController` | `profile.*` |
| `/settings/*` | `SettingsController` | `settings.*` |

Detail variable Blade → lihat [docs/FE-CONTRACT.md](docs/FE-CONTRACT.md).

---

## Development Workflow

```bash
# Terminal 1
npm run dev

# Terminal 2
./artisan-dev serve   # atau: php artisan serve (setelah php8.3-xml terpasang)
```

---

## Checklist Progress

- [x] Fase 0 — Prerequisites (Laravel 11 + packages; Laravel 12 butuh PHP 8.4)
- [x] Fase 1 — Foundation
- [x] Fase 2 — Database (migrations, models, seeders)
- [x] Fase 3 — Auth
- [x] Fase 4 — Master Data
- [x] Fase 5 — Transactions
- [x] Fase 6 — Dashboard & Reports
- [x] Fase 7 — Settings & Profile
- [x] Fase 8 — Book Import
- [x] Fase 9 — Frontend Integration (sample-data dihapus dari views)

---

## File Structure Plan

```
docs/
├── 00-prerequisites.md
├── 01-foundation.md
├── 02-database.md
├── 03-auth.md
├── 04-master-data.md
├── 05-transactions.md
├── 06-dashboard-reports.md
├── 07-settings-profile.md
├── 08-book-import.md
├── 09-frontend-integration.md
└── FE-CONTRACT.md
```

Setiap file prompt berisi: **Prerequisites**, **Objective**, **Rules**, **Output**, **Do NOT**.
