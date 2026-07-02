<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\ReportRepositoryInterface;

class ReportService extends BaseService
{
    public function __construct(private readonly ReportRepositoryInterface $repository) {}

    public function index(array $filters = [])
    {
        return [
            'bookReports' => $this->repository->books($filters),
            'memberReports' => $this->repository->members($filters),
            'borrowingReports' => $this->repository->borrowings($filters),
            'fineReports' => $this->repository->fines($filters),
        ];
    }
}
