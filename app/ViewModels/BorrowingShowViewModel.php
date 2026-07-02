<?php

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\Borrowing;

final class BorrowingShowViewModel
{
    public function __construct(private readonly Borrowing $borrowing) {}

    public function toArray(): array
    {
        return (new BorrowingIndexViewModel(collect([$this->borrowing])))->toArray();
    }
}
