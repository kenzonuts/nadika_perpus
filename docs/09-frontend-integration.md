# Fase 9 — Frontend Integration

## Prerequisites

- [x] Fase 0–8 (all backend modules)

## Role

Senior Laravel Architect, Enterprise Software Engineer.

## Objective

Connect existing Blade UI to backend **without modifying view files**. Replace `Route::view()` with controllers + ViewModels.

## Critical Rules

1. **DO NOT edit** `resources/views/**` unless variable name is impossible to match via ViewModel
2. **DO NOT** change HTML, CSS, Tailwind classes, or Alpine components
3. Use [FE-CONTRACT.md](FE-CONTRACT.md) for all variable mapping
4. Controllers return `view('existing.view', $viewModel->toArray())`

## Route Migration

Replace in `routes/web.php`:

### Before

```php
Route::view('/books', 'books.index')->name('books.index');
```

### After

```php
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    // ... all routes
});
```

## Full Route Map

| Current Route::view | Controller@method |
|--------------------|-------------------|
| `/` | `LandingController@index` |
| `/dashboard` | `DashboardController@index` |
| `/books/*` | `BookController` resource + trash/restore/import |
| `/categories/*` | `CategoryController` resource + trash |
| `/members/*` | `MemberController` resource + trash |
| `/borrowings/*` | `BorrowingController` |
| `/returns/*` | `BookReturnController` |
| `/reports/*` | `ReportController` |
| `/audit/*` | `AuditController` |
| `/profile/*` | `ProfileController` |
| `/settings/*` | `SettingsController` |
| Auth routes | Breeze controllers (Fase 3) |

## ViewModel Checklist

Create ViewModel for every page that currently uses `sample-data.blade.php`:

| View | ViewModel | Remove |
|------|-----------|--------|
| `books.index` | `BookIndexViewModel` | `@include sample-data` |
| `books.show` | `BookShowViewModel` | sample-data |
| `books.create/edit` | `BookFormViewModel` | sample-data |
| `books.trash` | `BookTrashViewModel` | sample-data |
| `categories.*` | `Category*ViewModel` | sample-data |
| `members.*` | `Member*ViewModel` | sample-data |
| `borrowings.*` | `Borrowing*ViewModel` | sample-data |
| `returns.*` | `BookReturn*ViewModel` | sample-data |
| `reports.*` | `Report*ViewModel` | sample-data |
| `audit.*` | `Audit*ViewModel` | sample-data |
| `dashboard.index` | `DashboardViewModel` | hardcoded stats |

## Sample Data Removal

After integration, delete or empty:

```
resources/views/**/partials/sample-data.blade.php
```

Replace `@include` with controller-provided variables.

## Middleware Groups

```php
// Public
Route::get('/', ...);

// Guest auth
Route::middleware('guest')->group(fn () => /* login, register */);

// Authenticated
Route::middleware(['auth', 'verified'])->group(fn () => /* dashboard, modules */);

// Admin only
Route::middleware(['auth', 'role:super-admin|librarian'])->group(fn () => /* settings.system */);
```

## Flash Messages

Match existing UI alert components:

```php
return redirect()->route('books.index')
    ->with('success', 'Book created successfully.');
```

Verify Blade reads `session('success')` — adjust key in controller only if needed.

## Error Handling

Validation errors → redirect back with `$errors` (Laravel default, works with Blade).

## API Routes (prepare, optional)

```php
// routes/api.php
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::apiResource('books', Api\BookController::class);
    // ...
});
```

## Verification Checklist

Walk through every route in browser:

- [ ] `/` landing loads
- [ ] `/login` auth works, redirects to dashboard
- [ ] `/dashboard` shows real statistics
- [ ] `/books` shows DB books with correct status/available
- [ ] `/books/create` form submits
- [ ] `/books/trash` shows soft-deleted
- [ ] `/categories/*` works
- [ ] `/members/*` works
- [ ] `/borrowings/*` works
- [ ] `/returns/*` works
- [ ] `/reports/*` shows real data
- [ ] `/audit/*` shows Spatie logs
- [ ] `/profile/*` works
- [ ] `/settings/*` saves to system_settings
- [ ] `/books/import` works
- [ ] Vite HMR still works (`npm run dev` + `@vite` in head)
- [ ] No visual changes to any page

## Testing (Pest)

- Feature test per route returns 200 with auth
- ViewModel output matches FE-CONTRACT keys
- Guest redirected from protected routes

## Output

- [ ] All `Route::view` replaced
- [ ] All ViewModels created
- [ ] sample-data removed
- [ ] Middleware applied
- [ ] Full app functional with real data
- [ ] Zero Blade file modifications (or document any minimal exceptions)

## Do NOT

- Do NOT redesign UI
- Do NOT add new frontend features
- Do NOT break existing route names (named routes must stay same)
