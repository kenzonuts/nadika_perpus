<?php

declare(strict_types=1);

namespace App\Services;

use App\Jobs\ProcessBookImportJob;

class BookImportService extends BaseService
{
    public function queue(string $filePath, ?string $userId = null): void
    {
        ProcessBookImportJob::dispatch($filePath, $userId);
    }

    public function processRows(array $rows): void
    {
        foreach ($rows as $row) {
            \App\Models\Book::query()->create($row);
        }
    }
}
