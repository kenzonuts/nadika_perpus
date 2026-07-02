<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileService extends BaseService
{
    public function updateProfile(User $user, array $attributes): User
    {
        $user->fill([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'phone' => $attributes['phone'] ?? null,
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return $user->fresh() ?? $user;
    }

    public function updatePassword(User $user, string $currentPassword, string $newPassword): void
    {
        if (! Hash::check($currentPassword, $user->password)) {
            abort(422, 'Current password is invalid.');
        }

        $user->update(['password' => Hash::make($newPassword)]);
    }
}
