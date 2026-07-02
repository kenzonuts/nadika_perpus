<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreBorrowingRequest;
use App\Http\Requests\UpdateBorrowingRequest;
use App\Models\Borrowing;
use App\Services\BorrowingService;
use App\ViewModels\BorrowingCreateViewModel;
use App\ViewModels\BorrowingIndexViewModel;
use App\ViewModels\BorrowingShowViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BorrowingController extends Controller
{
    public function index(): View
    {
        $rows = Borrowing::query()->with(['member.user', 'items.book', 'bookReturns'])->latest()->get();

        return view('borrowings.index', array_merge(['borrowings' => (new BorrowingIndexViewModel($rows))->toArray()], (new BorrowingCreateViewModel())->toArray()));
    }

    public function create(): View
    {
        return view('borrowings.create', (new BorrowingCreateViewModel())->toArray());
    }

    public function store(StoreBorrowingRequest $request, BorrowingService $service): RedirectResponse
    {
        $service->createWithItems($request->validated());

        return redirect()->route('borrowings.index');
    }

    public function show(Borrowing $borrowing): View
    {
        $borrowing->load(['member.user', 'items.book', 'bookReturns']);

        return view('borrowings.show', array_merge([
            'borrowings' => (new BorrowingShowViewModel($borrowing))->toArray(),
            'borrowingTimeline' => [],
        ], (new BorrowingCreateViewModel())->toArray()));
    }

    public function update(UpdateBorrowingRequest $request, Borrowing $borrowing): RedirectResponse
    {
        $borrowing->update($request->validated());

        return redirect()->route('borrowings.show', $borrowing);
    }

    public function history(): View
    {
        $rows = Borrowing::query()->with(['member.user', 'items.book', 'bookReturns'])->latest()->get();

        return view('borrowings.history', array_merge(['borrowingHistory' => (new BorrowingIndexViewModel($rows))->toArray()], (new BorrowingCreateViewModel())->toArray()));
    }
}
