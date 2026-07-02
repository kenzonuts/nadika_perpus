<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function findByEmail(string $email): ?\App\Models\User;
}
