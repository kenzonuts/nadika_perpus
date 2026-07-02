<?php

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\Member;

final class MemberShowViewModel
{
    public function __construct(private readonly Member $member) {}

    public function toArray(): array
    {
        return (new MemberIndexViewModel(collect([$this->member])))->toArray();
    }
}
