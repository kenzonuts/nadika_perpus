<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\DashboardRepositoryInterface;

class DashboardService extends BaseService
{
    public function __construct(private readonly DashboardRepositoryInterface $repository) {}

    public function data()
    {
        return [
            'stats' => $this->repository->statistics(),
            'popularBooks' => $this->repository->popularBooks(),
            'recentBorrowings' => $this->repository->recentBorrowings(),
        ];
    }
}
