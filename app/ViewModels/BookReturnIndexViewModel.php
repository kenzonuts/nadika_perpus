<?php

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\BookReturn;
use Illuminate\Support\Collection;

final class BookReturnIndexViewModel
{
    public function __construct(private readonly Collection $returns) {}

    public function toArray(): array
    {
        return $this->returns->map(fn (BookReturn $return): array => [
            'id' => $return->id,
            'borrowing_id' => $return->borrowing_id,
            'member' => $return->borrowing?->member?->user?->name ?? '-',
            'member_id' => $return->borrowing?->member?->member_number ?? '-',
            'book' => $return->borrowing?->items->first()?->book?->title ?? '-',
            'book_id' => $return->borrowing?->items->first()?->book?->id,
            'isbn' => $return->borrowing?->items->first()?->book?->isbn ?? '-',
            'borrow_date' => $return->borrowing?->borrow_date?->format('d M Y') ?? '-',
            'due_date' => $return->borrowing?->due_date?->format('d M Y') ?? '-',
            'return_date' => $return->returned_date?->format('d M Y') ?? '-',
            'returned_date' => $return->returned_date?->format('d M Y') ?? '-',
            'processed_by' => $return->processor?->name ?? 'System',
            'condition' => $return->items->first()?->condition?->value ?? 'good',
            'days_late' => (int) ($return->items->first()?->late_days ?? 0),
            'is_late' => (int) ($return->items->first()?->late_days ?? 0) > 0,
            'notes' => $return->notes,
            'fine_amount' => (float) ($return->items->first()?->borrowingItem?->fine?->amount ?? 0),
            'fine_paid' => ($return->items->first()?->borrowingItem?->fine?->status?->value ?? '') === 'paid',
        ])->all();
    }
}
