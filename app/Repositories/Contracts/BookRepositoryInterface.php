<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface BookRepositoryInterface extends BaseRepositoryInterface
{
    public function paginateTrashed(int $perPage = 15): \Illuminate\Contracts\Pagination\LengthAwarePaginator;
}
