<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Shelf;
use App\Models\User;

class ShelfPolicy
{
    public function viewAny(User $user): bool { return $user->can('shelfs.viewAny'); }
    public function view(User $user, Shelf $shelf): bool { return $user->can('shelfs.view'); }
    public function create(User $user): bool { return $user->can('shelfs.create'); }
    public function update(User $user, Shelf $shelf): bool { return $user->can('shelfs.update'); }
    public function delete(User $user, Shelf $shelf): bool { return $user->can('shelfs.delete'); }
}
