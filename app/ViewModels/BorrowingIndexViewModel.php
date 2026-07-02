<?php

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\Borrowing;
use Illuminate\Support\Collection;

final class BorrowingIndexViewModel
{
    public function __construct(private readonly Collection $borrowings) {}

    public function toArray(): array
    {
        return $this->borrowings->map(fn (Borrowing $borrowing): array => [
            'id' => $borrowing->id,
            'borrow_number' => $borrowing->borrow_number,
            'member' => $borrowing->member?->user?->name ?? '-',
            'member_id' => $borrowing->member?->member_number ?? '-',
            'book' => $borrowing->items->first()?->book?->title ?? '-',
            'book_id' => $borrowing->items->first()?->book?->id,
            'isbn' => $borrowing->items->first()?->book?->isbn ?? '-',
            'borrow_date' => $borrowing->borrow_date->format('d M Y'),
            'due_date' => $borrowing->due_date->format('d M Y'),
            'status' => $borrowing->status->value,
            'notes' => $borrowing->notes,
            'returned_date' => optional($borrowing->bookReturns->first()?->returned_date)->format('d M Y'),
        ])->all();
    }
}
