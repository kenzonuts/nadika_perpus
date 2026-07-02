# Fase 7 — Settings & Profile

## Prerequisites

- [x] Fase 0–3 (auth required)
- [x] Fase 2 (system_settings table)

## Role

Senior Laravel Architect, Enterprise Software Engineer.

## Objective

Backend for Settings and Profile pages that **already exist in frontend**.

## Frontend Routes (existing — do not modify views)

| Route | View |
|-------|------|
| `/profile` | `profile.index` |
| `/profile/security` | `profile.security` |
| `/profile/activity` | `profile.activity` |
| `/settings/general` | `settings.general` |
| `/settings/library` | `settings.library` |
| `/settings/security` | `settings.security` |
| `/settings/notifications` | `settings.notifications` |
| `/settings/system` | `settings.system` |

## Settings Module

### Stack

`SettingsController`, `SettingsService`, `SettingsRepository`, `UpdateSettingsRequest`, `SettingsViewModel`

### SettingsService

```php
// Hierarchy: system_settings DB → config/library.php fallback
SettingsService::get('borrow_limit'); // returns runtime value
SettingsService::set('borrow_limit', 5);
SettingsService::getByGroup('library'); // for settings pages
```

### Groups & Keys

| Group | Keys |
|-------|------|
| general | library_name, library_tagline, contact_email, contact_phone, library_address, timezone, locale |
| library | borrow_limit, loan_duration, fine_per_day, max_books_per_member |
| security | session_timeout, password_expiry_days, two_factor_required |
| notifications | email_notifications, borrow_reminder, overdue_reminder, fine_notification |
| system | maintenance_mode, debug_mode, log_level |

### Authorization

- View settings: `settings.view` (librarian+)
- Update settings: `settings.update` (super-admin only for system/security)

## Profile Module

Extend auth profile (Fase 3) with dedicated pages:

### `ProfileController`

- `index` → profile overview
- `security` → password, sessions, 2FA status
- `activity` → user's activity log entries (Spatie)

### `ProfileActivityViewModel`

Map Spatie activity_log to format expected by `profile/activity.blade.php`.

## Activity Log for Profile

Filter `activity_log` where `causer_id = auth()->id()`.

## Testing (Pest)

- Settings CRUD with permission checks
- Config fallback when DB key missing
- Profile activity list
- Security settings restricted to super-admin

## Output

- [ ] SettingsService with DB + config hierarchy
- [ ] SettingsController for all 5 settings pages
- [ ] ProfileController for 3 profile pages
- [ ] ViewModels matching existing form field names
- [ ] Pest tests

## Do NOT

- Do NOT modify `resources/views/settings/*` or `profile/*`
- Do NOT implement full 2FA (stub on security page)
