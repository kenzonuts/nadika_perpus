<?php

declare(strict_types=1);

namespace App\Services\Cache;

use Illuminate\Support\Facades\Cache;

class CacheService implements CacheServiceInterface
{
    private const string DASHBOARD_KEY = 'library.dashboard';

    private const string STATISTICS_KEY = 'library.statistics';

    private const string POPULAR_BOOKS_KEY = 'library.popular_books';

    public function rememberDashboard(callable $callback): mixed
    {
        $ttl = (int) config('library.cache_ttl.dashboard', 300);

        return Cache::remember(self::DASHBOARD_KEY, $ttl, $callback);
    }

    public function rememberStatistics(callable $callback): mixed
    {
        $ttl = (int) config('library.cache_ttl.statistics', 600);

        return Cache::remember(self::STATISTICS_KEY, $ttl, $callback);
    }

    public function rememberPopularBooks(callable $callback): mixed
    {
        $ttl = (int) config('library.cache_ttl.popular_books', 3600);

        return Cache::remember(self::POPULAR_BOOKS_KEY, $ttl, $callback);
    }

    public function flushModule(string $module): void
    {
        match ($module) {
            'dashboard' => Cache::forget(self::DASHBOARD_KEY),
            'statistics' => Cache::forget(self::STATISTICS_KEY),
            'popular_books' => Cache::forget(self::POPULAR_BOOKS_KEY),
            'all' => $this->flushAll(),
            default => Cache::forget("library.{$module}"),
        };
    }

    private function flushAll(): void
    {
        Cache::forget(self::DASHBOARD_KEY);
        Cache::forget(self::STATISTICS_KEY);
        Cache::forget(self::POPULAR_BOOKS_KEY);
    }
}
