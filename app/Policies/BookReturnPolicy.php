<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\BookReturn;
use App\Models\User;

class BookReturnPolicy
{
    public function viewAny(User $user): bool { return $user->can('bookreturns.viewAny'); }
    public function view(User $user, BookReturn $bookreturn): bool { return $user->can('bookreturns.view'); }
    public function create(User $user): bool { return $user->can('bookreturns.create'); }
    public function update(User $user, BookReturn $bookreturn): bool { return $user->can('bookreturns.update'); }
    public function delete(User $user, BookReturn $bookreturn): bool { return $user->can('bookreturns.delete'); }
}
