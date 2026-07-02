<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Borrowing;
use App\Models\BorrowingItem;
use App\Models\ReturnItem;
use App\Repositories\Contracts\BookReturnRepositoryInterface;

class BookReturnService extends BaseService
{
    public function __construct(public readonly BookReturnRepositoryInterface $repository, private readonly FineService $fineService) {}

    public function processReturn(array $attributes)
    {
        return $this->runInTransaction(function () use ($attributes) {
            $borrowing = Borrowing::query()->with('items.book')->findOrFail($attributes['borrowing_id']);

            $return = $this->repository->create([
                'borrowing_id' => $borrowing->id,
                'returned_date' => $attributes['returned_date'] ?? now()->toDateString(),
                'notes' => $attributes['notes'] ?? null,
                'processed_by' => auth()->id(),
            ]);

            foreach ($attributes['items'] as $itemData) {
                $item = BorrowingItem::query()->with('book')->findOrFail($itemData['borrowing_item_id']);
                $lateDays = now()->startOfDay()->diffInDays($borrowing->due_date->startOfDay(), false) < 0 ? abs(now()->startOfDay()->diffInDays($borrowing->due_date->startOfDay(), false)) : 0;

                ReturnItem::query()->create([
                    'book_return_id' => $return->id,
                    'borrowing_item_id' => $item->id,
                    'condition' => $itemData['condition'] ?? 'good',
                    'late_days' => $lateDays,
                    'notes' => $itemData['notes'] ?? null,
                ]);

                $item->update(['status' => 'returned', 'returned_at' => now()]);
                $item->book?->increment('available_stock', $item->quantity);
                $this->fineService->autoCalculate($item, $lateDays, (string) ($itemData['condition'] ?? 'good'));
            }

            $hasOpen = BorrowingItem::query()->where('borrowing_id', $borrowing->id)->where('status', '!=', 'returned')->exists();
            if (! $hasOpen) {
                $borrowing->update(['status' => 'returned']);
            }

            return $return->fresh(['items.borrowingItem.book', 'borrowing.member.user']);
        });
    }
}
