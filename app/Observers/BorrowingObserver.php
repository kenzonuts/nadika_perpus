<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Borrowing;

class BorrowingObserver
{
    public function creating(Borrowing $borrowing): void
    {
        if (empty($borrowing->borrow_number)) { $borrowing->borrow_number = 'BRW-'.now()->format('YmdHis').'-'.str_pad((string) random_int(1, 999), 3, '0', STR_PAD_LEFT); }
    }
}
