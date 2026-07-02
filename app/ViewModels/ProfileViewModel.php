<?php

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\User;

final class ProfileViewModel
{
    public function __construct(private readonly User $user) {}

    public function toArray(): array
    {
        return [
            'user' => [
                'name' => $this->user->name,
                'email' => $this->user->email,
                'phone' => $this->user->phone,
            ],
        ];
    }
}
