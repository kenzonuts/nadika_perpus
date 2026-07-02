<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Fine;
use App\Models\User;

class FinePolicy
{
    public function viewAny(User $user): bool { return $user->can('fines.viewAny'); }
    public function view(User $user, Fine $fine): bool { return $user->can('fines.view'); }
    public function create(User $user): bool { return $user->can('fines.create'); }
    public function update(User $user, Fine $fine): bool { return $user->can('fines.update'); }
    public function delete(User $user, Fine $fine): bool { return $user->can('fines.delete'); }
}
