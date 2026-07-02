<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

final class PermissionHelper
{
    public static function userCan(Authenticatable $user, string $permission): bool
    {
        if (! $user instanceof User) {
            return false;
        }

        return $user->can($permission);
    }

    public static function userHasRole(Authenticatable $user, string|array $roles): bool
    {
        if (! $user instanceof User) {
            return false;
        }

        return $user->hasRole($roles);
    }

    /**
     * @param  array<int, string>  $permissions
     */
    public static function userHasAnyPermission(Authenticatable $user, array $permissions): bool
    {
        if (! $user instanceof User) {
            return false;
        }

        return $user->hasAnyPermission($permissions);
    }

    /**
     * @param  array<int, string>  $permissions
     */
    public static function userHasAllPermissions(Authenticatable $user, array $permissions): bool
    {
        if (! $user instanceof User) {
            return false;
        }

        return $user->hasAllPermissions($permissions);
    }
}
