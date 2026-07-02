<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\BookReturn;
use App\Repositories\Contracts\BookReturnRepositoryInterface;

class BookReturnRepository extends BaseRepository implements BookReturnRepositoryInterface
{
    public function __construct(BookReturn $model)
    {
        parent::__construct($model);
    }


}
