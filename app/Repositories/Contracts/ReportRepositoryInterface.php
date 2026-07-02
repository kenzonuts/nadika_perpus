<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface ReportRepositoryInterface
{
    public function books(array $filters = []): array;
    public function members(array $filters = []): array;
    public function borrowings(array $filters = []): array;
    public function fines(array $filters = []): array;
}
