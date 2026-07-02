<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }


    public function paginateTrashed(int $perPage = 15): LengthAwarePaginator
    {
        return Category::query()->onlyTrashed()->latest()->paginate($perPage);
    }
}
