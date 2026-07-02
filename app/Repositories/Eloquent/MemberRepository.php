<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Member;
use App\Repositories\Contracts\MemberRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MemberRepository extends BaseRepository implements MemberRepositoryInterface
{
    public function __construct(Member $model)
    {
        parent::__construct($model);
    }


    public function paginateTrashed(int $perPage = 15): LengthAwarePaginator
    {
        return Member::query()->onlyTrashed()->latest()->paginate($perPage);
    }
}
