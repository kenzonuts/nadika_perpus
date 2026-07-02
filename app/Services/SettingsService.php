<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\SettingsRepositoryInterface;

class SettingsService extends BaseService
{
    public function __construct(private readonly SettingsRepositoryInterface $repository) {}

    public function group(string $group)
    {
        return $this->repository->allByGroup($group);
    }

    public function updateGroup(string $group, array $settings): void
    {
        $this->repository->upsertMany($group, $settings);
    }
}
