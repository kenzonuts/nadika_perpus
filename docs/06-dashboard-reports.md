# Fase 6 — Dashboard, Analytics & Reports

## Prerequisites

- [x] Fase 0–5

## Role

Senior Laravel Architect, Business Intelligence Engineer, PostgreSQL Expert.

## Objective

Backend for Dashboard UI, Analytics, Reports, Audit Center, Notification Center. Optimized & cached.

## Modules

1. Dashboard Statistics
2. Analytics Engine
3. Reports + Export
4. Audit Center (Spatie Activitylog)
5. Notification Center

## Dashboard

### Stack

`DashboardController`, `DashboardService`, `DashboardStatisticsService`, `DashboardViewModel`

### Statistics (cached, TTL from config)

| Metric | Query |
|--------|-------|
| Total Books | `books.count()` |
| Available Books | `sum(available_stock)` |
| Borrowed Books | active borrowing_items |
| Archived Books | `publication_status = archived` |
| Total / Active / Inactive Members | by `MemberStatus` |
| Today's Borrow / Return | date filter |
| Late Returns | `due_date < today` AND status active |
| Outstanding / Paid Fines | by `FineStatus` |
| Total Categories / Shelves | count |

### Popular Books

`PopularBooksService` — top borrowed, trending (30 days), recently added, low stock (< 3)

## Analytics

`AnalyticsController`, `AnalyticsService`, `AnalyticsRepository`

### Features

- Borrow per day/week/month/year
- Return statistics
- Fine statistics
- Popular categories & authors
- Library growth (books over time)
- Member growth

Return data as arrays for Alpine.js charts in existing dashboard Blade.

## Reports

`ReportController`, `ReportService`, `ReportRepository`

### Report Types

| Type | Route |
|------|-------|
| Books | `/reports/books` |
| Members | `/reports/members` |
| Borrowings | `/reports/borrowings` |
| Fines | `/reports/fines` |
| Inventory | prepare |
| Activity | prepare |

### Filters

Date range, category, book, member, status, librarian

### Export (queued for large datasets)

`ExportService` interface + implementations:

- `PdfExportService` (prepare — dompdf/snappy)
- `ExcelExportService` (prepare — maatwebsite/excel)
- `CsvExportService`

```bash
# Install when implementing export
composer require barryvdh/laravel-dompdf
composer require maatwebsite/excel
```

## Audit Center

`AuditController`, `AuditService` — reads from Spatie `activity_log` table.

### Features

- List with filters (user, action, model, date range)
- Show detail (old/new values, IP, user agent)
- Activity types: model changes, login, security events

**Do NOT** create separate `activity_logs` table.

### Routes

`/audit`, `/audit/{id}` → existing views

## Notification Center

`NotificationController`, `NotificationService`

- Unread count
- Mark read / mark all read
- Delete notification
- Uses Laravel `notifications` table

## Cache Strategy

| Key | TTL | Invalidate on |
|-----|-----|---------------|
| `dashboard.stats` | 300s | borrow, return, book CRUD |
| `analytics.{period}` | 600s | borrow, return |
| `reports.{type}.{hash}` | 300s | related data change |
| `popular.books` | 3600s | borrow |

## Performance Rules

- Eager load all relationships
- No N+1 (use `with()`)
- Pagination on all lists
- Use existing DB indexes
- Queue exports > 1000 rows

## ViewModels

`DashboardViewModel`, `ReportIndexViewModel`, `AuditIndexViewModel` — match existing Blade variable names.

## Testing (Pest)

- Statistics accuracy
- Cache invalidation
- Report filters
- Audit log retrieval
- Authorization per policy

## Output

- [ ] Dashboard statistics service + ViewModel
- [ ] Analytics service with chart data
- [ ] Report service + filters
- [ ] Export service interfaces
- [ ] Audit service (Spatie-based)
- [ ] Notification center
- [ ] Cache layer active
- [ ] Pest tests

## Do NOT

- Do NOT modify Blade files
- Do NOT implement OWASP hardening phase (separate future phase)
- Do NOT wire routes until Fase 9
