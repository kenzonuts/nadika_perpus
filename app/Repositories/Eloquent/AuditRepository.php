<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\AuditRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\Activitylog\Models\Activity;

class AuditRepository implements AuditRepositoryInterface
{
    public function paginate(int $perPage = 20): LengthAwarePaginator
    {
        return Activity::query()->with('causer')->latest()->paginate($perPage);
    }
}
