<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Fine;
use App\Repositories\Contracts\FineRepositoryInterface;

class FineRepository extends BaseRepository implements FineRepositoryInterface
{
    public function __construct(Fine $model)
    {
        parent::__construct($model);
    }


}
