<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use App\ViewModels\CategoryFormViewModel;
use App\ViewModels\CategoryIndexViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(CategoryService $service): View
    {
        $categories = $service->paginate()->getCollection();

        return view('categories.index', [
            'categories' => (new CategoryIndexViewModel($categories))->toArray(),
            'statuses' => ['active', 'inactive', 'draft'],
        ]);
    }

    public function create(): View
    {
        return view('categories.create', (new CategoryFormViewModel())->toArray());
    }

    public function store(StoreCategoryRequest $request, CategoryService $service): RedirectResponse
    {
        $service->create($request->validated());
        return redirect()->route('categories.index');
    }

    public function show(Category $category): View
    {
        $category->load('books');

        return view('categories.show', [
            'categories' => (new CategoryIndexViewModel(collect([$category])))->toArray(),
            'categoryBooks' => $category->books->map(fn ($book): array => [
                'id' => $book->id,
                'title' => $book->title,
                'author' => $book->author,
                'status' => $book->publication_status->value,
                'updated_at' => $book->updated_at?->diffForHumans(),
            ])->all(),
        ]);
    }

    public function edit(Category $category): View
    {
        return view('categories.edit', (new CategoryFormViewModel($category))->toArray());
    }

    public function update(UpdateCategoryRequest $request, Category $category, CategoryService $service): RedirectResponse
    {
        $service->update($category->id, $request->validated());
        return redirect()->route('categories.show', $category);
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->route('categories.index');
    }

    public function trash(CategoryService $service): View
    {
        $trashed = $service->trash()->getCollection();

        return view('categories.trash', ['trashedCategories' => (new CategoryIndexViewModel($trashed))->toArray()]);
    }

    public function restore(string $id, CategoryService $service): RedirectResponse
    {
        $service->restore($id);
        return redirect()->route('categories.trash');
    }
}
