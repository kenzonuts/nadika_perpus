<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Hash;

class AuthenticationService extends BaseService
{
    public function __construct(private readonly UserRepositoryInterface $users, private readonly StatefulGuard $guard) {}

    public function register(array $attributes)
    {
        $user = $this->users->create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'phone' => $attributes['phone'] ?? null,
            'password' => Hash::make($attributes['password']),
        ]);

        event(new Registered($user));
        $this->guard->login($user);

        return $user;
    }

    public function logout(): void
    {
        $this->guard->logout();
    }
}
