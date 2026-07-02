<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Borrowing;
use App\Repositories\Contracts\BorrowingRepositoryInterface;

class BorrowingRepository extends BaseRepository implements BorrowingRepositoryInterface
{
    public function __construct(Borrowing $model)
    {
        parent::__construct($model);
    }


}
