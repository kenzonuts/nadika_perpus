<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Services\Cache\CacheServiceInterface;

class ClearCacheListener
{
    public function __construct(
        private readonly CacheServiceInterface $cacheService,
    ) {}

    /**
     * @param  object  $event
     */
    public function handle(object $event): void
    {
        $module = match ($event::class) {
            \App\Events\BookCreated::class,
            \App\Events\BookUpdated::class => 'popular_books',
            \App\Events\BookBorrowed::class,
            \App\Events\BookReturned::class => 'statistics',
            \App\Events\MemberCreated::class => 'dashboard',
            \App\Events\FineGenerated::class => 'statistics',
            default => 'all',
        };

        $this->cacheService->flushModule($module);
        $this->cacheService->flushModule('dashboard');
    }
}
