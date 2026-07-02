# Frontend Contract — Variable Mapping

> Kontrak data antara Backend dan Blade yang **sudah ada**.  
> Controller/ViewModel **wajib** mengirim data dengan nama ini agar FE tidak perlu diubah.

---

## Books

| Blade / FE | Database / Model | Catatan |
|------------|------------------|---------|
| `$book['id']` | `books.id` (UUID) | |
| `$book['title']` | `books.title` | |
| `$book['subtitle']` | `books.subtitle` | |
| `$book['isbn']` | `books.isbn` | |
| `$book['author']` | `books.author` | |
| `$book['publisher']` | `books.publisher` | |
| `$book['category']` | `category.name` | String, bukan ID |
| `$book['shelf']` | `shelf.code` | String, bukan ID |
| `$book['language']` | `books.language` | |
| `$book['year']` | `books.publication_year` | Accessor `year` |
| `$book['pages']` | `books.pages` | |
| `$book['stock']` | `books.stock` | |
| `$book['available']` | `books.available_stock` | Accessor `available` |
| `$book['status']` | `books.publication_status` | `published\|draft\|archived` |
| `$book['description']` | `books.description` | |
| `$book['cover']` | `books.cover` | URL Supabase |
| `$book['rating']` | computed | Dari aggregate borrow (optional) |
| `$book['borrows']` | computed | Count borrowing_items |
| `$book['color']` | computed | Dari category hash (optional) |
| `$book['updated_at']` | `books.updated_at` | Human-readable via Carbon |

### Book Filter Options (filter-bar.blade.php)

- Availability filter: `available` / `unavailable` → derived dari `available_stock > 0`
- Status filter: `published` / `draft` / `archived`

---

## Categories

| Blade | Model |
|-------|-------|
| `$category['name']` | `categories.name` |
| `$category['slug']` | `categories.slug` |
| `$category['description']` | `categories.description` |

---

## Members

| Blade | Model |
|-------|-------|
| `$member['member_number']` | `members.member_number` |
| `$member['name']` | `user.name` atau `members.name` |
| `$member['email']` | `user.email` |
| `$member['phone']` | `members.phone` |
| `$member['status']` | `members.status` → `active\|inactive\|suspended` |
| `$member['photo']` | `members.photo` URL |

---

## Borrowings

| Blade | Model |
|-------|-------|
| `$borrowing['borrow_number']` | `borrowings.borrow_number` |
| `$borrowing['member']` | `member.user.name` |
| `$borrowing['borrow_date']` | formatted date |
| `$borrowing['due_date']` | formatted date |
| `$borrowing['status']` | `borrowings.status` |

---

## Dashboard

| Blade variable | Source |
|----------------|--------|
| Stat cards | `DashboardStatisticsService` |
| Recent activities | Spatie `activity_log` |
| Popular books | `PopularBooksQuery` |
| Charts data | `AnalyticsService` (JSON for Alpine) |

---

## Settings (settings/*.blade.php)

| Form field | `system_settings` key |
|------------|----------------------|
| `library_name` | `library_name` |
| `library_tagline` | `library_tagline` |
| `contact_email` | `contact_email` |
| `contact_phone` | `contact_phone` |
| `address` | `library_address` |
| `borrow_limit` | `borrow_limit` |
| `loan_duration` | `loan_duration` |
| `fine_per_day` | `fine_per_day` |

---

## ViewModel Pattern

```php
// app/ViewModels/BookIndexViewModel.php
final class BookIndexViewModel
{
    public function __construct(private readonly Collection $books) {}

    public function toArray(): array
    {
        return $this->books->map(fn (Book $book) => [
            'id' => $book->id,
            'title' => $book->title,
            'available' => $book->available_stock,
            'status' => $book->publication_status->value,
            'year' => $book->publication_year,
            // ...
        ])->all();
    }
}
```

Controller:

```php
return view('books.index', [
    'books' => (new BookIndexViewModel($books))->toArray(),
]);
```
