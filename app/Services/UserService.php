<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserService extends BaseService
{
    public function __construct(private readonly UserRepositoryInterface $users) {}

    public function findById(string $id): User
    {
        /** @var User $user */
        $user = $this->users->findOrFail($id);

        return $user;
    }

    public function update(string $id, array $attributes): User
    {
        /** @var User $user */
        $user = $this->users->update($id, $attributes);

        return $user;
    }
}
