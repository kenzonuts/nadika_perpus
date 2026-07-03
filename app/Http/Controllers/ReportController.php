<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ReportFilterRequest;
use App\Services\ReportService;
use App\Services\StatisticsService;
use App\ViewModels\ReportIndexViewModel;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(ReportFilterRequest $request, ReportService $service): View
    {
        return view('reports.index', (new ReportIndexViewModel($service->index($request->validated())))->toArray());
    }

    public function books(ReportFilterRequest $request, ReportService $service, StatisticsService $statistics): View
    {
        $payload = $service->index($request->validated());

        return view('reports.books', (new ReportIndexViewModel($payload, $statistics->reportBookStatCards(collect($payload['bookReports'] ?? []))))->toArray());
    }

    public function members(ReportFilterRequest $request, ReportService $service, StatisticsService $statistics): View
    {
        return view('reports.members', (new ReportIndexViewModel($service->index($request->validated()), $statistics->reportMemberStatCards()))->toArray());
    }

    public function borrowings(ReportFilterRequest $request, ReportService $service, StatisticsService $statistics): View
    {
        return view('reports.borrowings', (new ReportIndexViewModel($service->index($request->validated()), $statistics->reportBorrowingStatCards()))->toArray());
    }

    public function fines(ReportFilterRequest $request, ReportService $service, StatisticsService $statistics): View
    {
        return view('reports.fines', (new ReportIndexViewModel($service->index($request->validated()), $statistics->reportFineStatCards()))->toArray());
    }
}
