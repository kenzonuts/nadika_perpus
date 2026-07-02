<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\BookReturn;

class BookReturnObserver
{
    public function creating(BookReturn $bookReturn): void
    {
        if (empty($bookReturn->returned_date)) { $bookReturn->returned_date = now()->toDateString(); }
    }
}
