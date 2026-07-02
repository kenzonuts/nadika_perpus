<?php

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\Member;
use Illuminate\Support\Collection;

final class MemberIndexViewModel
{
    public function __construct(private readonly Collection $members) {}

    public function toArray(): array
    {
        return $this->members->map(function (Member $member): array {
            $name = $member->user?->name ?? $member->member_number;

            return [
                'id' => $member->id,
                'member_number' => $member->member_number,
                'name' => $name,
                'email' => $member->user?->email ?? '-',
                'phone' => $member->phone,
                'status' => $member->status->value,
                'photo' => $member->photo,
                'membership_type' => 'Standard',
                'borrowed_count' => $member->borrowings()->where('status', 'active')->count(),
                'join_date' => optional($member->joined_at)->format('d M Y') ?? '-',
                'avatar_initials' => collect(explode(' ', $name))->map(fn ($word): string => strtoupper(substr($word, 0, 1)))->join(''),
                'qr_code' => $member->member_number,
                'color' => 'from-primary/80 to-primary',
                'address' => $member->address,
                'notes' => null,
            ];
        })->all();
    }
}
