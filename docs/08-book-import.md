# Fase 8 — Book Import

## Prerequisites

- [x] Fase 0–4 (Books module)

## Role

Senior Laravel Architect, Enterprise Software Engineer.

## Objective

Backend for `/books/import` page — bulk import books from CSV/Excel.

## Frontend

Existing view: `resources/views/books/import.blade.php`

FE expects preview table with rows containing `status` = `valid` | `invalid`.

## Stack

- `BookImportController`
- `ImportBooksAction`
- `BookImportService`
- `ParseCsvAction`, `ParseExcelAction`
- `ValidateBookRowAction`
- `ProcessBookImportJob` (queued)
- `BookImportDTO`
- `ImportBookRequest`

## Flow

```
1. Upload file (CSV/XLSX)
2. Parse → array of rows
3. Validate each row → mark valid/invalid with errors
4. Return preview to view (no DB write yet)
5. User confirms → dispatch ProcessBookImportJob
6. Job creates books in DB::transaction batches of 50
7. Activity log + cache invalidation
```

## Validation per Row

| Field | Rule |
|-------|------|
| title | required |
| isbn | required, unique (skip duplicate in file) |
| author | required |
| category | must exist (by name or create option — config) |
| shelf | must exist (by code) |
| stock | numeric ≥ 0 |
| publication_status | published\|draft\|archived |

## File Rules

- Max size: `config('library.max_upload_size_kb')` KB
- Allowed: csv, xlsx
- Store temp file in `storage/app/imports/` (local, not Supabase)

## Packages

```bash
composer require maatwebsite/excel
```

## Routes

```
GET  /books/import          → preview form
POST /books/import/preview  → parse + validate, return preview
POST /books/import/process  → queue import job
GET  /books/import/status   → job progress (optional)
```

## Permissions

`books.create` required.

## Testing (Pest)

- Valid CSV import
- Invalid rows rejected
- Duplicate ISBN handling
- Large file queued
- Transaction rollback on batch failure

## Output

- [ ] Import service + actions
- [ ] Queued batch job
- [ ] Controller with preview/process
- [ ] ViewModel for preview table matching FE
- [ ] Pest tests

## Do NOT

- Do NOT modify `resources/views/books/import.blade.php`
- Do NOT import members/borrowings in this phase
