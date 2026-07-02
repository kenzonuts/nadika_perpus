<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    public function viewAny(User $user): bool { return $user->can('categorys.viewAny'); }
    public function view(User $user, Category $category): bool { return $user->can('categorys.view'); }
    public function create(User $user): bool { return $user->can('categorys.create'); }
    public function update(User $user, Category $category): bool { return $user->can('categorys.update'); }
    public function delete(User $user, Category $category): bool { return $user->can('categorys.delete'); }
}
