<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Shelf;
use App\Repositories\Contracts\ShelfRepositoryInterface;

class ShelfRepository extends BaseRepository implements ShelfRepositoryInterface
{
    public function __construct(Shelf $model)
    {
        parent::__construct($model);
    }


}
