# Fase 5 — Library Transactions

## Prerequisites

- [x] Fase 0–4

## Role

Senior Laravel Architect, PostgreSQL Expert, Security Engineer.

## Objective

Core business logic: Borrow, Return, Fine, Inventory. **All in Service layer with PostgreSQL transactions.**

## Modules

- Borrowings + BorrowingItems
- Book Returns + ReturnItems
- Fines
- Inventory Management (automatic)
- Notifications (queued)

## Borrowing Module

### Stack

`BorrowingController`, `BorrowingService`, `BorrowingRepository`, `BorrowingPolicy`, `BorrowingObserver`, `StoreBorrowingRequest`, `BorrowBookAction`, `CancelBorrowAction`, `BorrowingIndexViewModel`

### Features

- Borrow single/multiple books
- Auto-generate `borrow_number` (BRW-YYYY-XXXXXX)
- Auto-calculate `due_date` from `system_settings.loan_duration` (fallback `config/library.php`)
- Borrow summary & receipt data (for ViewModel)

### Business Rules (enforce in Service)

| Rule | Action |
|------|--------|
| Book `publication_status` = archived | Reject |
| `available_stock` < quantity | Reject |
| Member `status` ≠ active | Reject |
| Active borrows ≥ borrow_limit | Reject |
| Same book already in active borrow for member | Reject |
| On success | Decrease `available_stock`, increase `borrow_count` |

### Transaction

```php
DB::transaction(function () {
    // create borrowing + items
    // update stock
    // dispatch BookBorrowed event
});
// Rollback on ANY failure
```

## Return Module

### Stack

`BookReturnController`, `BookReturnService`, `BookReturnRepository`, `ReturnBookAction`, `BookReturnIndexViewModel`

> Model: `BookReturn`, table: `book_returns` — NOT `returns`.

### Features

- Return per `borrowing_item` (via `return_items`)
- Calculate `late_days` = max(0, returned_date - due_date)
- Auto-generate fine if overdue
- Return summary & receipt

### Business Rules

| Rule | Action |
|------|--------|
| On return | Increase `available_stock`, set item `returned_at` |
| All items returned | Set borrowing status = `returned` |
| Overdue | Create `Fine` per item: `late_days × fine_per_day` |
| Condition = lost | Additional fine (configurable) |

### Fine Calculation

```php
$amount = $lateDays * SettingsService::get('fine_per_day', config('library.fine_per_day'));
```

Fine linked to `borrowing_item_id` — not borrowing header.

## Fine Module

`FineController`, `FineService`, `FineRepository`, `FinePolicy`

### Features

- Auto-created on overdue return
- Manual waive (permission: `fines.manage`)
- Mark as paid
- Status: unpaid → paid | waived

## Inventory Management (automatic)

Listeners on `BookBorrowed`, `BookReturned`:

- Update `available_stock`
- Update `borrow_count`
- Invalidate `popular_books` cache

## Notifications (queued)

| Notification | Trigger |
|--------------|---------|
| BorrowSuccess | BookBorrowed |
| ReturnSuccess | BookReturned |
| OverdueReminder | Scheduled job (prepare) |
| FineCreated | FineGenerated |
| FinePaid | FinePaid |

## Events & Listeners

| Event | Listeners |
|-------|-----------|
| `BookBorrowed` | UpdateStock, WriteActivityLog, SendNotification, ClearCache |
| `BookReturned` | UpdateStock, GenerateFine, WriteActivityLog, SendNotification |
| `BorrowCancelled` | RestoreStock, WriteActivityLog |
| `FineGenerated` | SendNotification, WriteActivityLog |
| `FinePaid` | WriteActivityLog, ClearCache |

## Report Preparation (queries only)

Reusable query classes in `App\Repositories\Queries\`:

- `DailyBorrowQuery`
- `MonthlyBorrowQuery`
- `PopularBooksQuery`
- `LateReturnsQuery`
- `OutstandingFinesQuery`

## Routes (prepare)

```
/borrowings, /borrowings/create, /borrowings/history, /borrowings/{id}
/returns, /returns/{id}
```

## Testing (Pest)

- Borrow happy path + all rejection rules
- Return with/without fine
- Stock consistency after borrow/return cycle
- Transaction rollback on failure
- Policy authorization

## Output

- [ ] Full borrowing/return/fine services with transactions
- [ ] Inventory auto-update
- [ ] Queued notifications
- [ ] Events & listeners wired
- [ ] Report query classes
- [ ] Pest tests

## Do NOT

- Do NOT build Dashboard/Reports UI backend
- Do NOT modify Blade files
- Do NOT wire routes until Fase 9 (optional early wire)
