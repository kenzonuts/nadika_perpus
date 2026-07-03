<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\BookPublicationStatus;
use App\Enums\BorrowingStatus;
use App\Enums\MemberStatus;
use App\Models\Book;
use App\Models\BookReturn;
use App\Models\Borrowing;
use App\Models\Category;
use App\Models\Fine;
use App\Models\Member;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Spatie\Activitylog\Models\Activity;

class StatisticsService extends BaseService
{
    public function dashboardStats(): array
    {
        return [
            'books' => Book::query()->count(),
            'members' => Member::query()->count(),
            'active_borrowings' => Borrowing::query()->where('status', BorrowingStatus::Active)->count(),
            'overdue_borrowings' => Borrowing::query()->where('status', BorrowingStatus::Overdue)->count(),
            'unpaid_fines' => (float) Fine::query()->where('status', 'unpaid')->sum('amount'),
        ];
    }

    public function popularBooks(int $limit = 5): array
    {
        return Book::query()
            ->with('category:id,name')
            ->orderByDesc('borrow_count')
            ->limit($limit)
            ->get()
            ->map(fn (Book $book): array => [
                'id' => $book->id,
                'title' => $book->title,
                'author' => $book->author,
                'category' => $book->category?->name ?? '-',
                'borrows' => $book->borrow_count,
                'available' => $book->available_stock > 0,
                'rating' => number_format(min(5, max(3, 4 + ($book->borrow_count / 100))), 1),
                'status' => $book->available_stock > 0 ? 'Available' : 'Borrowed',
                'variant' => $book->available_stock > 0 ? 'success' : 'warning',
                'color' => 'from-primary/80 to-primary',
            ])
            ->all();
    }

    public function recentBorrowings(int $limit = 5): array
    {
        return Borrowing::query()
            ->with(['member.user:id,name', 'items.book:id,title', 'bookReturns'])
            ->latest()
            ->limit($limit)
            ->get()
            ->map(fn (Borrowing $borrowing): array => [
                'member' => $borrowing->member?->user?->name ?? '-',
                'book' => $borrowing->items->first()?->book?->title ?? '-',
                'status' => ucfirst($borrowing->status->value),
                'variant' => match ($borrowing->status) {
                    BorrowingStatus::Returned => 'success',
                    BorrowingStatus::Overdue => 'danger',
                    default => 'warning',
                },
                'return' => optional($borrowing->bookReturns->first()?->returned_date)->format('d M Y') ?? 'Pending',
            ])
            ->all();
    }

    public function recentActivity(int $limit = 5, ?string $causerId = null): array
    {
        $query = Activity::query()->with('causer')->latest();

        if ($causerId !== null) {
            $query->where('causer_id', $causerId)->where('causer_type', User::class);
        }

        return $query
            ->limit($limit)
            ->get()
            ->map(fn (Activity $activity): array => $this->mapActivity($activity))
            ->all();
    }

    public function subjectActivity(object $subject, int $limit = 5): array
    {
        return Activity::query()
            ->forSubject($subject)
            ->latest()
            ->limit($limit)
            ->get()
            ->map(fn (Activity $activity): array => $this->mapActivity($activity))
            ->all();
    }

    public function bookStatCards(): array
    {
        $borrowedCopies = max(0, (int) Book::query()->selectRaw('SUM(stock - available_stock) as borrowed')->value('borrowed'));

        return [
            ['title' => 'Total Books', 'value' => $this->formatCount(Book::query()->count()), 'icon' => 'book-open', 'color' => 'primary'],
            ['title' => 'Available Books', 'value' => $this->formatCount(Book::query()->where('available_stock', '>', 0)->count()), 'icon' => 'check-circle', 'color' => 'success'],
            ['title' => 'Borrowed Books', 'value' => $this->formatCount($borrowedCopies), 'icon' => 'arrow-right-circle', 'color' => 'warning'],
            ['title' => 'Archived Books', 'value' => $this->formatCount(Book::query()->where('publication_status', BookPublicationStatus::Archived)->count()), 'icon' => 'archive-box', 'color' => 'danger'],
        ];
    }

    public function memberStatCards(): array
    {
        $borrowingMemberIds = Borrowing::query()
            ->whereIn('status', [BorrowingStatus::Active, BorrowingStatus::Overdue])
            ->distinct()
            ->pluck('member_id');

        return [
            ['title' => 'Total Members', 'value' => $this->formatCount(Member::query()->count()), 'icon' => 'users', 'color' => 'primary'],
            ['title' => 'Active Members', 'value' => $this->formatCount(Member::query()->where('status', MemberStatus::Active)->count()), 'icon' => 'check-circle', 'color' => 'success'],
            ['title' => 'Currently Borrowing', 'value' => $this->formatCount($borrowingMemberIds->count()), 'icon' => 'book-open', 'color' => 'warning'],
            ['title' => 'Suspended / Inactive', 'value' => $this->formatCount(Member::query()->whereIn('status', [MemberStatus::Suspended, MemberStatus::Inactive])->count()), 'icon' => 'exclamation-triangle', 'color' => 'danger'],
        ];
    }

    public function categoryStatCards(): array
    {
        return [
            ['title' => 'Total Categories', 'value' => $this->formatCount(Category::query()->count()), 'icon' => 'rectangle-stack', 'color' => 'primary'],
            ['title' => 'With Books', 'value' => $this->formatCount(Category::query()->has('books')->count()), 'icon' => 'check-circle', 'color' => 'success'],
            ['title' => 'Empty Categories', 'value' => $this->formatCount(Category::query()->doesntHave('books')->count()), 'icon' => 'pencil-square', 'color' => 'warning'],
            ['title' => 'Books Categorized', 'value' => $this->formatCount(Book::query()->whereNotNull('category_id')->count()), 'icon' => 'book-open', 'color' => 'danger'],
        ];
    }

    public function borrowingStatCards(): array
    {
        $returnedThisMonth = Borrowing::query()
            ->where('status', BorrowingStatus::Returned)
            ->where('updated_at', '>=', Carbon::now()->startOfMonth())
            ->count();

        return [
            ['title' => 'Total Borrowings', 'value' => $this->formatCount(Borrowing::query()->count()), 'icon' => 'arrow-right-circle', 'color' => 'primary'],
            ['title' => 'Active Loans', 'value' => $this->formatCount(Borrowing::query()->where('status', BorrowingStatus::Active)->count()), 'icon' => 'book-open', 'color' => 'success'],
            ['title' => 'Overdue', 'value' => $this->formatCount(Borrowing::query()->where('status', BorrowingStatus::Overdue)->count()), 'icon' => 'exclamation-triangle', 'color' => 'danger'],
            ['title' => 'Returned This Month', 'value' => $this->formatCount($returnedThisMonth), 'icon' => 'arrow-left-circle', 'color' => 'warning'],
        ];
    }

    public function returnStatCards(): array
    {
        $lateReturns = BookReturn::query()->whereHas('items', fn ($q) => $q->where('late_days', '>', 0))->count();
        $unpaidFines = (float) Fine::query()->where('status', 'unpaid')->sum('amount');

        return [
            ['title' => 'Total Returns', 'value' => $this->formatCount(BookReturn::query()->count()), 'icon' => 'arrow-left-circle', 'color' => 'primary'],
            ['title' => 'On Time', 'value' => $this->formatCount(BookReturn::query()->whereDoesntHave('items', fn ($q) => $q->where('late_days', '>', 0))->count()), 'icon' => 'check-circle', 'color' => 'success'],
            ['title' => 'Late Returns', 'value' => $this->formatCount($lateReturns), 'icon' => 'clock', 'color' => 'warning'],
            ['title' => 'Unpaid Fines', 'value' => 'Rp '.number_format($unpaidFines, 0, ',', '.'), 'icon' => 'document-chart-bar', 'color' => 'danger'],
        ];
    }

    public function auditStatCards(): array
    {
        return [
            ['title' => 'Total Events', 'value' => $this->formatCount(Activity::query()->count()), 'icon' => 'clipboard-document-list', 'color' => 'primary'],
            ['title' => 'Created Events', 'value' => $this->formatCount(Activity::query()->where('event', 'created')->count()), 'icon' => 'plus-circle', 'color' => 'success'],
            ['title' => 'Deleted Events', 'value' => $this->formatCount(Activity::query()->where('event', 'deleted')->count()), 'icon' => 'trash', 'color' => 'danger'],
            ['title' => "Today's Events", 'value' => $this->formatCount(Activity::query()->whereDate('created_at', today())->count()), 'icon' => 'clock', 'color' => 'warning'],
        ];
    }

    public function reportBookStatCards(Collection $bookReports): array
    {
        $mostBorrowed = Book::query()->orderByDesc('borrow_count')->first();

        return [
            ['title' => 'Total Titles', 'value' => $this->formatCount(Book::query()->count()), 'icon' => 'book-open', 'color' => 'primary'],
            ['title' => 'Most Borrowed', 'value' => $mostBorrowed?->title ?? '-', 'icon' => 'star', 'color' => 'warning'],
            ['title' => 'Avg. Circulation', 'value' => number_format((float) Book::query()->avg('borrow_count'), 1).'x', 'icon' => 'arrow-path-rounded', 'color' => 'success'],
            ['title' => 'Low Stock Alerts', 'value' => $this->formatCount(Book::query()->where('available_stock', '<=', 1)->count()), 'icon' => 'exclamation-triangle', 'color' => 'danger'],
        ];
    }

    public function reportMemberStatCards(): array
    {
        return [
            ['title' => 'Total Members', 'value' => $this->formatCount(Member::query()->count()), 'icon' => 'users', 'color' => 'primary'],
            ['title' => 'New This Month', 'value' => $this->formatCount(Member::query()->where('created_at', '>=', Carbon::now()->startOfMonth())->count()), 'icon' => 'plus-circle', 'color' => 'success'],
            ['title' => 'Active Borrowers', 'value' => $this->formatCount(Borrowing::query()->whereIn('status', [BorrowingStatus::Active, BorrowingStatus::Overdue])->distinct('member_id')->count('member_id')), 'icon' => 'arrow-right-circle', 'color' => 'warning'],
            ['title' => 'Suspended', 'value' => $this->formatCount(Member::query()->where('status', MemberStatus::Suspended)->count()), 'icon' => 'x-circle', 'color' => 'danger'],
        ];
    }

    public function reportBorrowingStatCards(): array
    {
        $total = Borrowing::query()->count();
        $returnedOnTime = Borrowing::query()->where('status', BorrowingStatus::Returned)->count();
        $onTimeRate = $total > 0 ? round(($returnedOnTime / $total) * 100, 1) : 0;

        return [
            ['title' => 'Total Borrowings', 'value' => $this->formatCount($total), 'icon' => 'arrow-right-circle', 'color' => 'primary'],
            ['title' => 'Currently Active', 'value' => $this->formatCount(Borrowing::query()->where('status', BorrowingStatus::Active)->count()), 'icon' => 'clock', 'color' => 'success'],
            ['title' => 'Returned On Time', 'value' => $onTimeRate.'%', 'icon' => 'check-circle', 'color' => 'success'],
            ['title' => 'Overdue', 'value' => $this->formatCount(Borrowing::query()->where('status', BorrowingStatus::Overdue)->count()), 'icon' => 'exclamation-triangle', 'color' => 'danger'],
        ];
    }

    public function reportFineStatCards(): array
    {
        $collected = (float) Fine::query()->where('status', 'paid')->sum('amount');
        $outstanding = (float) Fine::query()->where('status', 'unpaid')->sum('amount');
        $avg = (float) Fine::query()->avg('amount');
        $waived = (float) Fine::query()->where('status', 'waived')->where('updated_at', '>=', Carbon::now()->startOfMonth())->sum('amount');

        return [
            ['title' => 'Total Collected', 'value' => 'Rp '.number_format($collected, 0, ',', '.'), 'icon' => 'document-chart-bar', 'color' => 'success'],
            ['title' => 'Outstanding', 'value' => 'Rp '.number_format($outstanding, 0, ',', '.'), 'icon' => 'exclamation-triangle', 'color' => 'danger'],
            ['title' => 'Avg. Fine Amount', 'value' => 'Rp '.number_format($avg, 0, ',', '.'), 'icon' => 'chart-bar', 'color' => 'warning'],
            ['title' => 'Waived This Month', 'value' => 'Rp '.number_format($waived, 0, ',', '.'), 'icon' => 'check-circle', 'color' => 'primary'],
        ];
    }

    public function landingStats(): array
    {
        $stats = $this->dashboardStats();

        return [
            ['label' => 'Total Books', 'value' => $stats['books'], 'icon' => 'book', 'color' => 'primary'],
            ['label' => 'Total Members', 'value' => $stats['members'], 'icon' => 'users', 'color' => 'success'],
            ['label' => 'Borrowed Books', 'value' => $stats['active_borrowings'], 'icon' => 'arrow-path', 'color' => 'warning'],
            ['label' => 'Late Returns', 'value' => $stats['overdue_borrowings'], 'icon' => 'exclamation-triangle', 'color' => 'danger'],
        ];
    }

    private function mapActivity(Activity $activity): array
    {
        $event = $activity->event ?? 'updated';

        return [
            'icon' => match ($event) {
                'created' => 'plus-circle',
                'deleted' => 'trash',
                default => 'pencil-square',
            },
            'title' => ucfirst($event).' '.str(class_basename((string) $activity->subject_type))->headline(),
            'description' => $activity->description,
            'message' => $activity->description,
            'time' => $activity->created_at?->diffForHumans() ?? '-',
            'color' => match ($event) {
                'deleted' => 'danger',
                'created' => 'success',
                default => 'primary',
            },
            'unread' => $activity->created_at?->gt(now()->subDay()) ?? false,
        ];
    }

    private function formatCount(int $value): string
    {
        return number_format($value);
    }
}
