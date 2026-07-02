<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Book;
use App\Models\BorrowingItem;
use App\Models\Member;
use App\Repositories\Contracts\BorrowingRepositoryInterface;

class BorrowingService extends BaseService
{
    public function __construct(public readonly BorrowingRepositoryInterface $repository) {}

    public function createWithItems(array $attributes)
    {
        return $this->runInTransaction(function () use ($attributes) {
            $member = Member::query()->findOrFail($attributes['member_id']);
            if ((string) $member->status->value !== 'active') {
                abort(422, 'Member is not active.');
            }

            $limit = (int) config('library.borrow_limit', 3);
            if (count($attributes['items']) > $limit) {
                abort(422, 'Borrowing limit exceeded.');
            }

            $borrowing = $this->repository->create([
                'member_id' => $attributes['member_id'],
                'borrow_number' => 'BRW-'.now()->format('YmdHis').'-'.str_pad((string) random_int(1, 999), 3, '0', STR_PAD_LEFT),
                'borrow_date' => $attributes['borrow_date'] ?? now()->toDateString(),
                'due_date' => $attributes['due_date'] ?? now()->addDays((int) config('library.loan_duration_days', 14))->toDateString(),
                'status' => 'active',
                'notes' => $attributes['notes'] ?? null,
            ]);

            foreach ($attributes['items'] as $item) {
                $book = Book::query()->findOrFail($item['book_id']);
                $qty = (int) ($item['quantity'] ?? 1);

                if ($book->available_stock < $qty) {
                    abort(422, sprintf('Book %s has insufficient stock.', $book->title));
                }

                $book->decrement('available_stock', $qty);
                $book->increment('borrow_count', $qty);

                BorrowingItem::query()->create([
                    'borrowing_id' => $borrowing->id,
                    'book_id' => $book->id,
                    'quantity' => $qty,
                    'status' => 'borrowed',
                ]);
            }

            return $borrowing->fresh(['items.book', 'member.user']);
        });
    }
}
