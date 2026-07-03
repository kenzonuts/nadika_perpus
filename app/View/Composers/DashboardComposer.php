<?php

declare(strict_types=1);

namespace App\View\Composers;

use App\Services\StatisticsService;
use Illuminate\View\View;

class DashboardComposer
{
    public function __construct(private readonly StatisticsService $statistics) {}

    public function compose(View $view): void
    {
        $view->with('notifications', $this->statistics->recentActivity(4));
    }
}
