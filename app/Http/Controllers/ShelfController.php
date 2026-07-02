<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreShelfRequest;
use App\Http\Requests\UpdateShelfRequest;
use App\Models\Shelf;
use App\Services\ShelfService;
use App\ViewModels\ShelfIndexViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ShelfController extends Controller
{
    public function index(ShelfService $service): View
    {
        $items = $service->repository->all();

        return view('settings.library', ['shelves' => (new ShelfIndexViewModel($items))->toArray()]);
    }

    public function store(StoreShelfRequest $request, ShelfService $service): RedirectResponse
    {
        $service->create($request->validated());

        return back();
    }

    public function update(UpdateShelfRequest $request, Shelf $shelf, ShelfService $service): RedirectResponse
    {
        $service->update($shelf->id, $request->validated());

        return back();
    }

    public function destroy(Shelf $shelf): RedirectResponse
    {
        $shelf->delete();

        return back();
    }
}
