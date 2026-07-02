<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\BookImportService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookImportController extends Controller
{
    public function create(): View { return view('books.import'); }

    public function store(Request $request, BookImportService $service): RedirectResponse
    {
        $request->validate(['file' => ['required', 'file']]);
        $path = $request->file('file')->store('imports');
        $service->queue(storage_path('app/private/'.$path), (string) auth()->id());
        return redirect()->route('books.index');
    }
}
