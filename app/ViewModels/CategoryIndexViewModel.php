<?php

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\Category;
use Illuminate\Support\Collection;

final class CategoryIndexViewModel
{
    public function __construct(private readonly Collection $categories) {}

    public function toArray(): array
    {
        return $this->categories->map(fn (Category $category): array => [
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'description' => $category->description,
            'status' => 'active',
            'books_count' => $category->books()->count(),
            'color' => 'from-primary/80 to-primary',
            'updated_at' => $category->updated_at?->diffForHumans(),
            'deleted_at' => $category->deleted_at?->diffForHumans(),
        ])->all();
    }
}
