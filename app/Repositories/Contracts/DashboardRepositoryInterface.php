<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface DashboardRepositoryInterface
{
    public function statistics(): array;
    public function popularBooks(int $limit = 5): array;
    public function recentBorrowings(int $limit = 5): array;
}
