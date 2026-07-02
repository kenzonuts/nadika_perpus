<?php

declare(strict_types=1);

namespace App\Services\Settings;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SettingsService
{
    private const string CACHE_KEY = 'library.system_settings';

    private const int CACHE_TTL = 3600;

    public function get(string $key, mixed $default = null): mixed
    {
        $settings = $this->all();

        if (array_key_exists($key, $settings)) {
            return $settings[$key];
        }

        $configValue = config("library.{$key}");

        return $configValue ?? $default;
    }

    public function set(string $key, mixed $value): void
    {
        if (! $this->tableExists()) {
            return;
        }

        DB::table('system_settings')->updateOrInsert(
            ['key' => $key],
            [
                'value' => $this->serializeValue($value),
                'updated_at' => now(),
            ],
        );

        Cache::forget(self::CACHE_KEY);
    }

    /**
     * @return array<string, mixed>
     */
    public function all(): array
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function (): array {
            if (! $this->tableExists()) {
                return [];
            }

            return DB::table('system_settings')
                ->pluck('value', 'key')
                ->map(fn (mixed $value): mixed => $this->deserializeValue($value))
                ->all();
        });
    }

    public function flush(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    private function tableExists(): bool
    {
        return Schema::hasTable('system_settings');
    }

    private function serializeValue(mixed $value): string
    {
        return json_encode($value, JSON_THROW_ON_ERROR);
    }

    private function deserializeValue(mixed $value): mixed
    {
        if (! is_string($value)) {
            return $value;
        }

        return json_decode($value, true, 512, JSON_THROW_ON_ERROR);
    }
}
