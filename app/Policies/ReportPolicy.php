<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;

class ReportPolicy
{
    public function viewAny(User $user): bool { return $user->can('reports.viewAny'); }
    public function export(User $user): bool { return $user->can('reports.export'); }
}
