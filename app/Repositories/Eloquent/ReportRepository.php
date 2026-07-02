<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Fine;
use App\Models\Member;
use App\Repositories\Contracts\ReportRepositoryInterface;

class ReportRepository implements ReportRepositoryInterface
{
    public function books(array $filters = []): array
    {
        return Book::query()->with('category:id,name')->get()->map(fn (Book $book): array => [
            'title' => $book->title,
            'category' => $book->category?->name ?? '-',
            'borrows' => $book->borrow_count,
            'available' => $book->available_stock,
            'stock' => $book->stock,
            'trend' => $book->borrow_count > 10 ? 'High' : 'Normal',
            'variant' => $book->borrow_count > 10 ? 'success' : 'neutral',
        ])->all();
    }

    public function members(array $filters = []): array
    {
        return Member::query()->with('user:id,name,email')->withCount('borrowings')->get()->map(fn (Member $member): array => [
            'name' => $member->user?->name ?? $member->member_number,
            'email' => $member->user?->email ?? '-',
            'borrows' => $member->borrowings_count,
            'fines' => '$0.00',
            'status' => ucfirst($member->status->value),
            'variant' => $member->status->value === 'active' ? 'success' : 'warning',
        ])->all();
    }

    public function borrowings(array $filters = []): array
    {
        return Borrowing::query()->with(['member.user:id,name', 'items.book:id,title', 'bookReturns'])->get()->map(fn (Borrowing $borrowing): array => [
            'member' => $borrowing->member?->user?->name ?? '-',
            'book' => $borrowing->items->first()?->book?->title ?? '-',
            'borrowed' => $borrowing->borrow_date->format('d M Y'),
            'due' => $borrowing->due_date->format('d M Y'),
            'returned' => optional($borrowing->bookReturns->first()?->returned_date)->format('d M Y') ?? 'Pending',
            'status' => ucfirst($borrowing->status->value),
            'variant' => $borrowing->status->value === 'returned' ? 'success' : 'warning',
        ])->all();
    }

    public function fines(array $filters = []): array
    {
        return Fine::query()->with('borrowingItem.borrowing.member.user:id,name')->get()->map(fn (Fine $fine): array => [
            'member' => $fine->borrowingItem?->borrowing?->member?->user?->name ?? '-',
            'book' => $fine->borrowingItem?->book?->title ?? '-',
            'amount' => '$'.number_format((float) $fine->amount, 2),
            'days' => 0,
            'issued' => $fine->created_at?->format('d M Y') ?? '-',
            'status' => ucfirst($fine->status->value),
            'variant' => $fine->status->value === 'paid' ? 'success' : 'danger',
        ])->all();
    }
}
