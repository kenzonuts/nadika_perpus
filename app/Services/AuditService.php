<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\AuditRepositoryInterface;

class AuditService extends BaseService
{
    public function __construct(private readonly AuditRepositoryInterface $repository) {}

    public function paginate(int $perPage = 20)
    {
        return $this->repository->paginate($perPage);
    }
}
