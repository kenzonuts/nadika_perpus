# Fase 1 — Backend Foundation

## Prerequisites (harus sudah selesai)

- [x] Fase 0 — Prerequisites

## Role

You are a Senior Laravel Architect, Enterprise Software Engineer, DevOps Engineer, and Security Engineer.

## Objective

Prepare production-ready enterprise architecture. **No CRUD, no migrations, no business models, no controllers.**

## Tech Stack

Laravel 12, PHP 8.3+, PostgreSQL (Supabase), Supabase Storage, Spatie Permission, Spatie Activitylog, Laravel Pint, PestPHP, UUID, Soft Delete.

## Project Structure

Create folders:

```
app/
├── Actions/Contracts/
├── DTO/
├── Enums/
├── Events/
├── Exceptions/
├── Helpers/
├── Http/Controllers/Api/
├── Http/Middleware/
├── Http/Requests/Concerns/
├── Http/Resources/
├── Listeners/
├── Models/
├── Observers/
├── Policies/
├── Repositories/Contracts/
├── Repositories/Eloquent/
├── Services/Contracts/
├── Services/Cache/
├── Services/Storage/
├── Support/Concerns/
├── Traits/
└── ViewModels/
```

## Packages to Install

```bash
composer require spatie/laravel-permission spatie/laravel-activitylog
composer require league/flysystem-aws-s3-v3 "^3.0"
composer require pestphp/pest pestphp/pest-plugin-laravel --dev
```

Publish configs (no migrations yet):

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="activitylog-config"
```

## BaseModel

```php
abstract class BaseModel extends Model
{
    use HasFactory, HasUuid, LogsActivity, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';

    abstract public function getActivityLogName(): string;
}
```

**Exception:** `User` extends `Authenticatable` + uses `HasUuid` trait — NOT `BaseModel`.

## Enums (create all, no models yet)

| Enum | Values |
|------|--------|
| `BookPublicationStatus` | published, draft, archived |
| `MemberStatus` | active, inactive, suspended |
| `BorrowingStatus` | pending, active, returned, cancelled, overdue |
| `BorrowingItemStatus` | borrowed, returned, overdue |
| `BookReturnCondition` | good, damaged, lost |
| `FineStatus` | unpaid, paid, waived |
| `Gender` | male, female, other |
| `NotificationType` | borrow, return, overdue, fine, system, security |

## Abstractions to Generate

| Layer | Files |
|-------|-------|
| Repository | `BaseRepositoryInterface`, `BaseRepository` |
| Service | `BaseServiceInterface`, `BaseService` (with `DB::transaction`) |
| Cache | `CacheServiceInterface`, `CacheService` |
| Storage | `StorageServiceInterface`, `SupabaseStorageService` |
| Helpers | `DateFormatter`, `ResponseHelper`, `UploadHelper`, `PermissionHelper` |
| Support | `ApiResponse`, `HasUuid`, `LogsActivity` traits |
| Exceptions | `BaseException`, `LibraryException`, `NotFoundException`, `UnauthorizedException` |
| Events (stub) | `BookCreated`, `BookBorrowed`, `BookReturned`, `MemberCreated` |
| Listeners (stub) | `SendNotification`, `WriteActivityLog`, `UpdateStatistics` |
| Observers (stub) | `BookObserver`, `MemberObserver`, `BorrowingObserver`, `BookReturnObserver` |
| Policies (stub) | Book, Category, Member, Borrowing, BookReturn, Fine, Report |
| Middleware | `SecureHeaders` |

## Configuration

### `config/library.php`

```php
return [
    'borrow_limit' => env('LIBRARY_BORROW_LIMIT', 3),
    'loan_duration_days' => env('LIBRARY_LOAN_DURATION', 14),
    'fine_per_day' => env('LIBRARY_FINE_PER_DAY', 5000),
    'max_upload_size_kb' => env('LIBRARY_MAX_UPLOAD_KB', 2048),
    'allowed_image_types' => ['jpg', 'jpeg', 'png', 'webp'],
    'cache_ttl' => [
        'dashboard' => 300,
        'statistics' => 600,
        'popular_books' => 3600,
    ],
];
```

> Runtime values dari `system_settings` table (Fase 2) akan override config ini.

### `config/logging.php` — add channels

- `activity`, `security`, `system` (daily driver)

### `config/filesystems.php` — add disk

- `supabase` (S3-compatible driver)

## Security Preparation

- Register `SecureHeaders` middleware in `bootstrap/app.php`
- Rate limiting prep in `bootstrap/app.php`
- Standardized JSON via `ResponseHelper`

## Testing Structure

```
tests/
├── Feature/Auth/
├── Feature/Books/
├── Unit/Services/
├── Unit/Helpers/
├── Unit/Enums/
└── Pest.php
```

Run `php artisan pest:install`.

## AppServiceProvider Bindings

Bind all interfaces to implementations (Cache, Storage, base repositories).

## Output Checklist

- [ ] All folders created
- [ ] BaseModel + traits
- [ ] All enums (8)
- [ ] Repository/Service abstractions
- [ ] Helpers (4)
- [ ] config/library.php
- [ ] Logging channels
- [ ] Supabase filesystem disk
- [ ] PestPHP installed
- [ ] Exception classes
- [ ] Event/Listener stubs
- [ ] Policy stubs
- [ ] Observer stubs

## Do NOT

- Do NOT create migrations
- Do NOT create business models (Book, Member, etc.)
- Do NOT create CRUD controllers
- Do NOT modify `resources/views/`
- Do NOT install Laravel Breeze yet
