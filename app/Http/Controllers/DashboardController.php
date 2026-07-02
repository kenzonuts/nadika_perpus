<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\DashboardService;
use App\ViewModels\DashboardViewModel;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(DashboardService $service): View
    {
        return view('dashboard.index', (new DashboardViewModel($service->data()))->toArray());
    }
}
