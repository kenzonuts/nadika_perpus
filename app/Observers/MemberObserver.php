<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Member;

class MemberObserver
{
    public function creating(Member $member): void
    {
        if (empty($member->joined_at)) { $member->joined_at = now(); }
    }
}
