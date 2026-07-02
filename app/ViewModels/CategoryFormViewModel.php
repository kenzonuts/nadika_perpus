<?php

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\Category;

final class CategoryFormViewModel
{
    public function __construct(private readonly ?Category $category = null) {}

    public function toArray(): array
    {
        return [
            'categories' => [[
                'id' => $this->category?->id,
                'name' => $this->category?->name ?? '',
                'slug' => $this->category?->slug ?? '',
                'description' => $this->category?->description ?? '',
                'status' => 'active',
            ]],
            'statuses' => ['active', 'inactive', 'draft'],
        ];
    }
}
