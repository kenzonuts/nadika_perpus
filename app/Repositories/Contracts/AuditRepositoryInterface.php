<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface AuditRepositoryInterface
{
    public function paginate(int $perPage = 20): \Illuminate\Contracts\Pagination\LengthAwarePaginator;
}
