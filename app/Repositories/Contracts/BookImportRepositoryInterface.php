<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface BookImportRepositoryInterface
{
    public function bulkInsert(array $rows): void;
}
