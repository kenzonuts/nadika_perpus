<?php

declare(strict_types=1);

namespace App\Services;

class DashboardService extends BaseService
{
    public function __construct(private readonly StatisticsService $statistics) {}

    public function data(): array
    {
        return [
            'stats' => $this->statistics->dashboardStats(),
            'popularBooks' => $this->statistics->popularBooks(),
            'recentBorrowings' => $this->statistics->recentBorrowings(),
            'recentActivity' => $this->statistics->recentActivity(5),
        ];
    }
}
