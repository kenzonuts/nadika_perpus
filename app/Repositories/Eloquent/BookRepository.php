<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Book;
use App\Repositories\Contracts\BookRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    public function __construct(Book $model)
    {
        parent::__construct($model);
    }


    public function paginateTrashed(int $perPage = 15): LengthAwarePaginator
    {
        return Book::query()->onlyTrashed()->latest()->paginate($perPage);
    }
}
