<?php

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\Member;

final class MemberFormViewModel
{
    public function __construct(private readonly ?Member $member = null) {}

    public function toArray(): array
    {
        return [
            'members' => $this->member ? (new MemberShowViewModel($this->member))->toArray() : [[
                'name' => '',
                'email' => '',
                'phone' => '',
                'membership_type' => 'Standard',
                'status' => 'active',
                'address' => '',
                'notes' => '',
                'avatar_initials' => 'N',
                'qr_code' => '',
            ]],
            'membershipTypes' => ['Basic', 'Standard', 'Premium', 'Student', 'Faculty'],
            'membershipStatuses' => ['active', 'inactive', 'suspended', 'expired'],
        ];
    }
}
