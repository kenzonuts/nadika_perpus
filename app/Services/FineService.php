<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\BorrowingItem;
use App\Repositories\Contracts\FineRepositoryInterface;

class FineService extends BaseService
{
    public function __construct(private readonly FineRepositoryInterface $fines) {}

    public function autoCalculate(BorrowingItem $item, int $lateDays, string $condition)
    {
        $perDay = (float) config('library.fine_per_day', 5000);
        $amount = $lateDays * $perDay;

        if ($condition === 'damaged') {
            $amount += $perDay * 2;
        }

        if ($condition === 'lost') {
            $amount += $perDay * 10;
        }

        if ($amount <= 0) {
            return null;
        }

        return $this->fines->create([
            'borrowing_item_id' => $item->id,
            'amount' => $amount,
            'reason' => 'Auto generated during return processing',
            'status' => 'unpaid',
        ]);
    }

    public function markPaid(string $id)
    {
        return $this->fines->update($id, ['status' => 'paid', 'paid_at' => now()]);
    }

    public function markWaived(string $id)
    {
        return $this->fines->update($id, ['status' => 'waived', 'waived_by' => auth()->id()]);
    }
}
