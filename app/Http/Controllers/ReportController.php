<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ReportFilterRequest;
use App\Services\ReportService;
use App\ViewModels\ReportIndexViewModel;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(ReportFilterRequest $request, ReportService $service): View
    {
        return view('reports.index', (new ReportIndexViewModel($service->index($request->validated())))->toArray());
    }

    public function books(ReportFilterRequest $request, ReportService $service): View
    {
        return view('reports.books', (new ReportIndexViewModel($service->index($request->validated())))->toArray());
    }

    public function members(ReportFilterRequest $request, ReportService $service): View
    {
        return view('reports.members', (new ReportIndexViewModel($service->index($request->validated())))->toArray());
    }

    public function borrowings(ReportFilterRequest $request, ReportService $service): View
    {
        return view('reports.borrowings', (new ReportIndexViewModel($service->index($request->validated())))->toArray());
    }

    public function fines(ReportFilterRequest $request, ReportService $service): View
    {
        return view('reports.fines', (new ReportIndexViewModel($service->index($request->validated())))->toArray());
    }
}
