<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    public function creating(Category $category): void
    {
        if (empty($category->slug)) { $category->slug = \Illuminate\Support\Str::slug($category->name); }
    }
}
