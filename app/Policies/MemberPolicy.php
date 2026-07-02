<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Member;
use App\Models\User;

class MemberPolicy
{
    public function viewAny(User $user): bool { return $user->can('members.viewAny'); }
    public function view(User $user, Member $member): bool { return $user->can('members.view'); }
    public function create(User $user): bool { return $user->can('members.create'); }
    public function update(User $user, Member $member): bool { return $user->can('members.update'); }
    public function delete(User $user, Member $member): bool { return $user->can('members.delete'); }
}
