<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Book;
use App\Models\BookReturn;
use App\Models\Borrowing;
use App\Models\Category;
use App\Models\Fine;
use App\Models\Member;
use App\Models\Shelf;
use App\Observers\BookObserver;
use App\Observers\BookReturnObserver;
use App\Observers\BorrowingObserver;
use App\Observers\CategoryObserver;
use App\Observers\MemberObserver;
use App\Policies\BookPolicy;
use App\Policies\BookReturnPolicy;
use App\Policies\BorrowingPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\FinePolicy;
use App\Policies\MemberPolicy;
use App\Policies\ReportPolicy;
use App\Policies\SettingsPolicy;
use App\Policies\ShelfPolicy;
use App\Repositories\Contracts\AuditRepositoryInterface;
use App\Repositories\Contracts\BookImportRepositoryInterface;
use App\Repositories\Contracts\BookRepositoryInterface;
use App\Repositories\Contracts\BookReturnRepositoryInterface;
use App\Repositories\Contracts\BorrowingRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\DashboardRepositoryInterface;
use App\Repositories\Contracts\FineRepositoryInterface;
use App\Repositories\Contracts\MemberRepositoryInterface;
use App\Repositories\Contracts\ReportRepositoryInterface;
use App\Repositories\Contracts\SettingsRepositoryInterface;
use App\Repositories\Contracts\ShelfRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\AuditRepository;
use App\Repositories\Eloquent\BookImportRepository;
use App\Repositories\Eloquent\BookRepository;
use App\Repositories\Eloquent\BookReturnRepository;
use App\Repositories\Eloquent\BorrowingRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\DashboardRepository;
use App\Repositories\Eloquent\FineRepository;
use App\Repositories\Eloquent\MemberRepository;
use App\Repositories\Eloquent\ReportRepository;
use App\Repositories\Eloquent\SettingsRepository;
use App\Repositories\Eloquent\ShelfRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Services\Cache\CacheService;
use App\Services\Cache\CacheServiceInterface;
use App\Services\Settings\SettingsService as LegacySettingsService;
use App\Services\Storage\StorageServiceInterface;
use App\Services\Storage\SupabaseStorageService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CacheServiceInterface::class, CacheService::class);
        $this->app->singleton(StorageServiceInterface::class, SupabaseStorageService::class);
        $this->app->singleton(LegacySettingsService::class);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ShelfRepositoryInterface::class, ShelfRepository::class);
        $this->app->bind(MemberRepositoryInterface::class, MemberRepository::class);
        $this->app->bind(BorrowingRepositoryInterface::class, BorrowingRepository::class);
        $this->app->bind(BookReturnRepositoryInterface::class, BookReturnRepository::class);
        $this->app->bind(FineRepositoryInterface::class, FineRepository::class);
        $this->app->bind(DashboardRepositoryInterface::class, DashboardRepository::class);
        $this->app->bind(ReportRepositoryInterface::class, ReportRepository::class);
        $this->app->bind(AuditRepositoryInterface::class, AuditRepository::class);
        $this->app->bind(SettingsRepositoryInterface::class, SettingsRepository::class);
        $this->app->bind(BookImportRepositoryInterface::class, BookImportRepository::class);
    }

    public function boot(): void
    {
        Book::observe(BookObserver::class);
        Category::observe(CategoryObserver::class);
        Member::observe(MemberObserver::class);
        Borrowing::observe(BorrowingObserver::class);
        BookReturn::observe(BookReturnObserver::class);

        Gate::policy(Book::class, BookPolicy::class);
        Gate::policy(Category::class, CategoryPolicy::class);
        Gate::policy(Shelf::class, ShelfPolicy::class);
        Gate::policy(Member::class, MemberPolicy::class);
        Gate::policy(Borrowing::class, BorrowingPolicy::class);
        Gate::policy(BookReturn::class, BookReturnPolicy::class);
        Gate::policy(Fine::class, FinePolicy::class);
        Gate::define('reports.viewAny', [ReportPolicy::class, 'viewAny']);
        Gate::define('reports.export', [ReportPolicy::class, 'export']);
        Gate::define('settings.view', [SettingsPolicy::class, 'view']);
        Gate::define('settings.update', [SettingsPolicy::class, 'update']);
    }
}
