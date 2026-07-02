<?php

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\Book;
use App\Models\Member;

final class BorrowingCreateViewModel
{
    public function toArray(): array
    {
        return [
            'availableBooks' => Book::query()->where('available_stock', '>', 0)->get(['id', 'title', 'isbn', 'available_stock'])->toArray(),
            'members' => Member::query()->with('user:id,name')->where('status', 'active')->get()->map(fn (Member $member): array => [
                'id' => $member->id,
                'name' => $member->user?->name ?? $member->member_number,
                'member_number' => $member->member_number,
            ])->all(),
            'borrowingStatuses' => ['active', 'returned', 'overdue'],
            'statusBadgeMap' => [
                'active' => ['label' => 'Active', 'variant' => 'warning'],
                'returned' => ['label' => 'Returned', 'variant' => 'success'],
                'overdue' => ['label' => 'Overdue', 'variant' => 'danger'],
            ],
        ];
    }
}
