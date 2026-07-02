<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Book;

class BookObserver
{
    public function creating(Book $book): void
    {
        if (! isset($book->available_stock)) { $book->available_stock = (int) $book->stock; }
    }
}
