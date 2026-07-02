<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\Cache\CacheService;
use App\Services\Cache\CacheServiceInterface;
use App\Services\Settings\SettingsService;
use App\Services\Storage\StorageServiceInterface;
use App\Services\Storage\SupabaseStorageService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CacheServiceInterface::class, CacheService::class);
        $this->app->singleton(StorageServiceInterface::class, SupabaseStorageService::class);
        $this->app->singleton(SettingsService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
