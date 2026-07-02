<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Fine;
use App\Models\Member;
use App\Repositories\Contracts\DashboardRepositoryInterface;

class DashboardRepository implements DashboardRepositoryInterface
{
    public function statistics(): array
    {
        return [
            'books' => Book::query()->count(),
            'members' => Member::query()->count(),
            'active_borrowings' => Borrowing::query()->where('status', 'active')->count(),
            'unpaid_fines' => (float) Fine::query()->where('status', 'unpaid')->sum('amount'),
        ];
    }

    public function popularBooks(int $limit = 5): array
    {
        return Book::query()->with('category:id,name')->latest()->limit($limit)->get()->map(fn (Book $book): array => [
            'id' => $book->id,
            'title' => $book->title,
            'category' => $book->category?->name ?? '-',
            'borrows' => $book->borrow_count,
            'status' => ucfirst($book->publication_status->value),
            'variant' => $book->available_stock > 0 ? 'success' : 'danger',
            'color' => 'from-primary/80 to-primary',
        ])->all();
    }

    public function recentBorrowings(int $limit = 5): array
    {
        return Borrowing::query()->with(['member.user:id,name', 'items.book:id,title', 'bookReturns'])->latest()->limit($limit)->get()->map(fn (Borrowing $borrowing): array => [
            'member' => $borrowing->member?->user?->name ?? '-',
            'book' => $borrowing->items->first()?->book?->title ?? '-',
            'status' => ucfirst($borrowing->status->value),
            'variant' => $borrowing->status->value === 'returned' ? 'success' : ($borrowing->status->value === 'overdue' ? 'danger' : 'warning'),
            'return' => optional($borrowing->bookReturns->first()?->returned_date)?->format('d M Y') ?? 'Pending',
        ])->all();
    }
}
