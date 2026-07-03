<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\StatisticsService;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function __invoke(StatisticsService $statistics): View
    {
        return view('landing.index', [
            'landingStats' => $statistics->landingStats(),
            'landingBooks' => $statistics->popularBooks(6),
            'landingActivity' => $statistics->recentActivity(3),
        ]);
    }
}
