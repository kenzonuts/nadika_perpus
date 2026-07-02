<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Services\BookService;
use App\ViewModels\BookFormViewModel;
use App\ViewModels\BookIndexViewModel;
use App\ViewModels\BookShowViewModel;
use App\ViewModels\BookTrashViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(BookService $service): View
    {
        $books = $service->paginate()->getCollection()->load(['category', 'shelf']);

        return view('books.index', [
            'books' => (new BookIndexViewModel($books))->toArray(),
            'categories' => $books->pluck('category.name')->filter()->unique()->values()->all(),
            'publishers' => $books->pluck('publisher')->filter()->unique()->values()->all(),
            'authors' => $books->pluck('author')->filter()->unique()->values()->all(),
        ]);
    }

    public function create(): View
    {
        return view('books.create', (new BookFormViewModel())->toArray());
    }

    public function store(StoreBookRequest $request, BookService $service): RedirectResponse
    {
        $service->create($request->validated());
        return redirect()->route('books.index');
    }

    public function show(Book $book): View
    {
        $book->load(['category', 'shelf', 'borrowingItems.borrowing.member.user']);

        return view('books.show', [
            'books' => (new BookShowViewModel($book))->toArray(),
            'borrowHistory' => $book->borrowingItems->map(fn ($item): array => [
                'action' => $item->status->value === 'returned' ? 'Returned' : 'Borrowed',
                'member' => $item->borrowing?->member?->user?->name ?? '-',
                'date' => $item->created_at?->diffForHumans() ?? '-',
                'color' => $item->status->value === 'returned' ? 'success' : 'warning',
            ])->all(),
        ]);
    }

    public function edit(Book $book): View
    {
        $book->load(['category', 'shelf']);

        return view('books.edit', (new BookFormViewModel($book))->toArray());
    }

    public function update(UpdateBookRequest $request, Book $book, BookService $service): RedirectResponse
    {
        $service->update($book->id, $request->validated());
        return redirect()->route('books.show', $book);
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();
        return redirect()->route('books.index');
    }

    public function trash(BookService $service): View
    {
        $trashed = $service->trash()->getCollection()->load(['category', 'shelf']);

        return view('books.trash', ['trashedBooks' => (new BookTrashViewModel($trashed))->toArray()]);
    }

    public function restore(string $id, BookService $service): RedirectResponse
    {
        $service->restore($id);
        return redirect()->route('books.trash');
    }

    public function forceDelete(string $id, BookService $service): RedirectResponse
    {
        $service->forceDelete($id);
        return redirect()->route('books.trash');
    }
}
