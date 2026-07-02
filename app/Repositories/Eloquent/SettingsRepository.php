<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\SystemSetting;
use App\Repositories\Contracts\SettingsRepositoryInterface;

class SettingsRepository implements SettingsRepositoryInterface
{
    public function allByGroup(string $group): array
    {
        return SystemSetting::query()->where('group', $group)->pluck('value', 'key')->all();
    }

    public function upsertMany(string $group, array $values): void
    {
        foreach ($values as $key => $value) {
            SystemSetting::query()->updateOrCreate(['key' => $key], ['group' => $group, 'value' => is_scalar($value) ? (string) $value : json_encode($value)]);
        }
    }
}
