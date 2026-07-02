# Fase 3 — Authentication & Authorization

## Prerequisites

- [x] Fase 0–2

## Role

Senior Laravel Architect, Security Engineer, Enterprise Software Engineer.

## Objective

Production-ready auth & authorization. **Reuse existing Blade auth views — do NOT overwrite them.**

## Critical Rule — Frontend Auth Views

FE already has these views — **use them, do not replace:**

| Route | Existing View |
|-------|---------------|
| `/login` | `auth.login` |
| `/register` | `auth.register` |
| `/forgot-password` | `auth.forgot-password` |
| `/reset-password` | `auth.reset-password` |
| `/verify-email` | `auth.verify-email` |
| `/confirm-password` | `auth.confirm-password` |
| `/two-factor` | `auth.two-factor` (prepare stub, implement later) |

**Breeze install strategy:**

```bash
composer require laravel/breeze --dev
php artisan breeze:install blade --no-interaction
```

Then **restore/repoint** Breeze controllers to render existing views instead of Breeze defaults. Delete generated Breeze views if they overwrite existing ones.

## Packages

```bash
composer require laravel/breeze --dev
composer require laravel/sanctum
# Telescope & Pulse — dev only, optional
composer require laravel/telescope --dev  # APP_ENV=local only
```

## Authentication Features

- Register, Login, Logout
- Forgot / Reset Password
- Email Verification
- Remember Me
- Password Confirmation
- Profile Update (name, email, phone, avatar)
- Change Password
- Avatar upload → Supabase `avatars` bucket
- Two-Factor (prepare route + stub, full impl later)

## Authorization — Spatie Permission

### Roles

| Role | Slug |
|------|------|
| Super Admin | `super-admin` |
| Librarian | `librarian` |
| Member | `member` |

### Permissions

```
books.view, books.create, books.update, books.delete
categories.view, categories.create, categories.update, categories.delete
members.view, members.create, members.update, members.delete
borrowings.view, borrowings.create, borrowings.update, borrowings.delete
returns.view, returns.create
fines.view, fines.manage
reports.view, reports.export
audit.view
settings.view, settings.update
users.manage
```

RolePermissionSeeder assigns permissions per role.

## Policies

Implement (use Spatie `$user->can()`):

- BookPolicy, CategoryPolicy, MemberPolicy
- BorrowingPolicy, BookReturnPolicy, FinePolicy
- ReportPolicy, UserPolicy, SettingsPolicy

Register in `AuthServiceProvider` or auto-discovery.

## Middleware

- `RoleMiddleware` — `role:super-admin|librarian`
- `PermissionMiddleware` — `permission:books.view`
- `EnsureUserIsActive` — block inactive users
- `EnsureEmailIsVerified` — for dashboard routes

## Form Requests

`LoginRequest`, `RegisterRequest`, `ProfileUpdateRequest`, `PasswordUpdateRequest`, `AvatarUploadRequest`

Password policy: min 12 chars, uppercase, lowercase, number, special char.

## Services

- `AuthenticationService`
- `UserService`
- `ProfileService`
- `RoleService`
- `PermissionService`
- `AvatarStorageService` (Supabase)

## Repositories

- `UserRepository`, `RoleRepository` (wrap Spatie/Eloquent)

## Security

- Rate limiting login: 5 attempts / minute
- Account lock after 5 failed attempts (15 min)
- Session regeneration on login
- CSRF, secure cookies, SameSite
- `SecureHeaders` middleware (from Fase 1)
- Log failed logins to `security` log channel

## Activity Log (Spatie)

Auto-log: login, logout, password changed, profile updated, avatar updated, failed login

## Notifications (prepare)

- `WelcomeNotification`
- `VerifyEmailNotification` (use Laravel default)
- `ResetPasswordNotification` (use Laravel default)
- `AccountLockedNotification`

## Routes

Replace `Route::view` auth routes with Breeze controllers pointing to existing views.

Protect dashboard routes:

```php
Route::middleware(['auth', 'verified'])->group(function () {
    // dashboard, books, etc. — still Route::view until Fase 9
});
```

## Testing (Pest)

- Login / logout
- Register validation
- Password reset flow
- Role & permission checks
- Rate limiting
- Inactive user blocked

## Output

- [ ] Breeze installed, existing views preserved
- [ ] Spatie roles & permissions seeded
- [ ] All auth controllers + services
- [ ] Policies registered
- [ ] Middleware active
- [ ] Avatar upload service (Supabase)
- [ ] Pest auth tests passing

## Do NOT

- Do NOT overwrite `resources/views/auth/*`
- Do NOT build Books/Categories/Members CRUD
- Do NOT implement full 2FA yet (stub only)
