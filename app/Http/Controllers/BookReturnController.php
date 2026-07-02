<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookReturnRequest;
use App\Models\BookReturn;
use App\Services\BookReturnService;
use App\ViewModels\BookReturnIndexViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookReturnController extends Controller
{
    public function index(): View
    {
        $returns = BookReturn::query()->with(['borrowing.member.user', 'borrowing.items.book', 'items.borrowingItem.fine', 'processor'])->latest()->get();

        return view('returns.index', [
            'returns' => (new BookReturnIndexViewModel($returns))->toArray(),
            'conditionBadgeMap' => [
                'good' => ['label' => 'Good', 'variant' => 'success'],
                'damaged' => ['label' => 'Damaged', 'variant' => 'danger'],
                'lost' => ['label' => 'Lost', 'variant' => 'danger'],
            ],
        ]);
    }

    public function show(BookReturn $bookReturn): View
    {
        $bookReturn->load(['borrowing.member.user', 'borrowing.items.book', 'items.borrowingItem.fine', 'processor']);

        return view('returns.show', [
            'returns' => (new BookReturnIndexViewModel(collect([$bookReturn])))->toArray(),
            'conditionBadgeMap' => [
                'good' => ['label' => 'Good', 'variant' => 'success'],
                'damaged' => ['label' => 'Damaged', 'variant' => 'danger'],
                'lost' => ['label' => 'Lost', 'variant' => 'danger'],
            ],
            'returnTimeline' => [],
        ]);
    }

    public function store(StoreBookReturnRequest $request, BookReturnService $service): RedirectResponse
    {
        $service->processReturn($request->validated());

        return redirect()->route('returns.index');
    }
}
