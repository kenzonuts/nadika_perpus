<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface SettingsRepositoryInterface
{
    public function allByGroup(string $group): array;
    public function upsertMany(string $group, array $values): void;
}
