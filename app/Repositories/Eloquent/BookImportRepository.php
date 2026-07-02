<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Book;
use App\Repositories\Contracts\BookImportRepositoryInterface;

class BookImportRepository implements BookImportRepositoryInterface
{
    public function bulkInsert(array $rows): void
    {
        foreach ($rows as $row) {
            Book::query()->create($row);
        }
    }
}
