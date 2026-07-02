<?php

declare(strict_types=1);

namespace App\Services\Cache;

interface CacheServiceInterface
{
    /**
     * @template TReturn
     *
     * @param  callable(): TReturn  $callback
     * @return TReturn
     */
    public function rememberDashboard(callable $callback): mixed;

    /**
     * @template TReturn
     *
     * @param  callable(): TReturn  $callback
     * @return TReturn
     */
    public function rememberStatistics(callable $callback): mixed;

    /**
     * @template TReturn
     *
     * @param  callable(): TReturn  $callback
     * @return TReturn
     */
    public function rememberPopularBooks(callable $callback): mixed;

    public function flushModule(string $module): void;
}
