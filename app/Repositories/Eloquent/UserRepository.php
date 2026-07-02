<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }


public function findByEmail(string $email): ?\App\Models\User
{
    /** @var \App\Models\User|null $user */
    $user = $this->newQuery()->where('email', $email)->first();

    return $user;
}
}
