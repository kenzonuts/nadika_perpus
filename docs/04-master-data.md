# Fase 4 — Enterprise Master Data

## Prerequisites

- [x] Fase 0–3

## Role

Senior Laravel Architect, Enterprise Software Engineer, Laravel 12 Expert.

## Objective

Build Books, Categories, Shelves, Members modules with full enterprise patterns. **Not simple CRUD.**

Reuse all architecture from previous phases. Never duplicate code.

## Modules

1. Books (+ book images, cover upload)
2. Categories
3. Shelves
4. Members

## Per-Module Stack

Each module generates:

| Layer | Files |
|-------|-------|
| Controller | `{Module}Controller` |
| Service | `{Module}Service` |
| Repository | `{Module}Repository` + Interface |
| Policy | Already from Fase 3 — implement methods |
| Observer | `{Module}Observer` |
| Form Requests | `Store{Module}Request`, `Update{Module}Request` |
| ViewModel | `{Module}IndexViewModel`, `{Module}ShowViewModel` |
| API Resource | `{Module}Resource`, `{Module}Collection` (API-ready) |
| Actions | `Delete{Module}Action`, `Restore{Module}Action` |
| DTO | `Create{Module}DTO`, `Update{Module}DTO` |
| Events | `{Module}Created`, `{Module}Updated`, `{Module}Deleted` |

## Books Module

### Features

CRUD, soft delete, restore, force delete, duplicate book, search, filter, sort, pagination, cover upload/replace/remove (Supabase `book-covers` bucket), import prep hook

### Business Rules

- ISBN unique
- `available_stock` ≤ `stock`
- Cannot delete category/shelf with active books (restrict)
- `publication_status` = enum `BookPublicationStatus` (published/draft/archived)
- Cannot borrow archived books (validated in Fase 5)

### FE Integration (ViewModel)

Must output arrays matching [FE-CONTRACT.md](FE-CONTRACT.md):

```php
'available' => $book->available_stock,
'status'  => $book->publication_status->value, // published|draft|archived
'year'    => $book->publication_year,
'category' => $book->category?->name,
'shelf'   => $book->shelf?->code,
```

### Routes (prepare, wire in Fase 9)

```
GET    /books              → index
GET    /books/create       → create
POST   /books              → store
GET    /books/{book}       → show
GET    /books/{book}/edit  → edit
PUT    /books/{book}       → update
DELETE /books/{book}       → destroy
GET    /books/trash        → trash
POST   /books/{book}/restore → restore
DELETE /books/{book}/force → forceDelete
```

## Categories Module

CRUD, slug auto-generate, book counter, soft delete, restore

## Shelves Module

CRUD, book counter, search, soft delete

## Members Module

Member number auto-generate (`MEM-YYYY-XXXX`), avatar upload (Supabase `avatars`), status management, borrow counter, search, filter, soft delete, restore

## Shared Architecture

### Search (reusable)

`App\Services\Search\SearchService` — apply filters, sort, pagination

### Cache

Invalidate on create/update/delete:

- `books.list`, `categories.list`, `dashboard.statistics`

### Activity Log

Auto via Spatie + observers: created, updated, deleted, restored

### Responses

Web: redirect + flash messages  
API: `ResponseHelper` JSON envelope

## Validation (Form Requests only)

| Module | Rules |
|--------|-------|
| Books | isbn unique, title required, stock numeric ≥ 0, category_id exists, shelf_id exists, image mimes:jpg,png,webp max:2MB |
| Members | member_number unique, email unique (if user), phone format |
| Categories | name required, slug unique |

## Testing (Pest)

Per module: CRUD, authorization, validation, soft delete/restore, search/filter

## Output

- [ ] 4 module controllers, services, repositories
- [ ] ViewModels per FE-CONTRACT
- [ ] Cover & avatar upload via SupabaseStorageService
- [ ] Events + listeners wired
- [ ] Observers registered
- [ ] Cache invalidation
- [ ] Pest tests per module

## Do NOT

- Do NOT implement Borrowing/Return/Fine
- Do NOT implement Dashboard/Reports
- Do NOT modify Blade files
- Do NOT wire routes yet (Fase 9) — or wire but keep views unchanged
