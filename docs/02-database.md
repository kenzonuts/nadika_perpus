# Fase 2 — Database Layer

## Prerequisites

- [x] Fase 0 — Prerequisites
- [x] Fase 1 — Backend Foundation

## Role

Senior Laravel Architect, PostgreSQL Database Engineer, Enterprise Software Architect.

## Objective

Build complete database layer on **Supabase PostgreSQL only**.

Reuse BaseModel, enums, traits from Fase 1. Do NOT recreate architecture.

## Rules

- Every table: UUID primary key (no auto-increment)
- Laravel generates UUID via `HasUuid` trait
- Soft deletes where noted
- Proper FK constraints + indexes
- **Do NOT** create custom `roles`, `permissions`, `activity_logs` tables — use Spatie migrations

## Spatie Migrations

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="activitylog-migrations"
```

## Tables to Create

### `users`

| Column | Type | Notes |
|--------|------|-------|
| id | uuid PK | |
| name | string | |
| email | string unique | indexed |
| password | string | |
| phone | string nullable | |
| avatar | string nullable | Supabase URL |
| email_verified_at | timestamp nullable | |
| remember_token | string nullable | |
| timestamps | | |
| deleted_at | soft delete | |

> Model: `User extends Authenticatable` + `HasUuid` — NOT BaseModel.

### `categories`

id, name, slug (unique, indexed), description, timestamps, deleted_at

### `shelves`

id, code (unique, indexed), name, location, description, timestamps, deleted_at

### `books`

| Column | Type |
|--------|------|
| id | uuid PK |
| category_id | uuid FK → categories |
| shelf_id | uuid FK → shelves |
| title | string, indexed |
| subtitle | string nullable |
| isbn | string unique, indexed |
| author | string, indexed |
| publisher | string nullable |
| publication_year | smallint nullable |
| language | string default 'English' |
| pages | integer nullable |
| description | text nullable |
| cover | string nullable |
| stock | integer default 0 |
| available_stock | integer default 0 |
| publication_status | string → enum `BookPublicationStatus` |
| borrow_count | integer default 0 |
| timestamps | |
| deleted_at | |

**Accessors for FE:**
- `getYearAttribute()` → `publication_year`
- `getAvailableAttribute()` → `available_stock`

### `book_images`

id, book_id (FK), path (string), is_primary (boolean), sort_order (integer), timestamps

### `members`

id, user_id (FK nullable), member_number (unique, indexed), phone, address, birth_date, gender (enum), photo, status (enum `MemberStatus`), joined_at, timestamps, deleted_at

### `borrowings`

id, member_id (FK), borrow_number (unique, indexed), borrow_date, due_date, status (enum `BorrowingStatus`), notes, timestamps

### `borrowing_items`

id, borrowing_id (FK), book_id (FK), quantity (default 1), status (enum `BorrowingItemStatus`), returned_at (nullable), timestamps

### `book_returns` (NOT `returns` — reserved word)

id, borrowing_id (FK), returned_date, notes, processed_by (FK users nullable), timestamps

### `return_items`

id, book_return_id (FK), borrowing_item_id (FK), condition (enum `BookReturnCondition`), late_days (integer default 0), notes, timestamps

### `fines`

id, borrowing_item_id (FK), amount (decimal), reason (string), status (enum `FineStatus`), paid_at (nullable), waived_by (FK users nullable), timestamps

### `notifications`

Use Laravel default: `php artisan notifications:table`

### `system_settings`

| Column | Type |
|--------|------|
| id | uuid PK |
| key | string unique |
| value | text/json |
| group | string (general, library, security, notifications, system) |
| timestamps | |

Default keys: `library_name`, `library_tagline`, `contact_email`, `contact_phone`, `library_address`, `borrow_limit`, `loan_duration`, `fine_per_day`, `email_notifications`, `maintenance_mode`

> Hierarchy: `config/library.php` = defaults, `system_settings` = runtime overrides.

## Relationships

```
User hasOne Member
Member belongsTo User
Category hasMany Books
Shelf hasMany Books
Book belongsTo Category, Shelf
Book hasMany BookImages
Member hasMany Borrowings
Borrowing belongsTo Member
Borrowing hasMany BorrowingItems
BorrowingItem belongsTo Book, Borrowing
BookReturn belongsTo Borrowing
BookReturn hasMany ReturnItems
ReturnItem belongsTo BorrowingItem, BookReturn
Fine belongsTo BorrowingItem
```

## Indexes

email, isbn, member_number, borrow_number, category_id, shelf_id, publication_status, borrowing status, created_at

## Foreign Keys

- `onDelete('restrict')` for books ← categories, shelves
- `onDelete('cascade')` for borrowing_items ← borrowings
- `onDelete('set null')` for members.user_id

## Factories & Seeders

| Seeder | Count |
|--------|-------|
| RolePermissionSeeder | roles: super-admin, librarian, member + all permissions |
| AdminSeeder | 3 default users (Super Admin, Librarian, Member) |
| CategorySeeder | 15+ |
| ShelfSeeder | 20+ |
| BookSeeder | 300+ |
| MemberSeeder | 100+ |
| BorrowingSeeder | 200+ |
| SettingsSeeder | all default keys |

## Models

All extend `BaseModel` except `User`. Each model:

- UUID, SoftDeletes (where applicable), HasFactory
- Spatie `LogsActivity`
- Fillable, casts (enums), relationships
- Accessors per FE-CONTRACT.md

## Output

- [ ] All migrations
- [ ] All models + relationships
- [ ] All factories
- [ ] All seeders
- [ ] `php artisan migrate --seed` succeeds on Supabase

## Do NOT

- Do NOT create controllers
- Do NOT create CRUD logic
- Do NOT create API routes
- Do NOT modify Blade files
- Do NOT create custom roles/permissions/activity_logs tables
