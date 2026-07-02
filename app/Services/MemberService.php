<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\MemberRepositoryInterface;

class MemberService extends BaseService
{
    public function __construct(public readonly MemberRepositoryInterface $repository) {}

    public function paginate(int $perPage = 15)
    {
        return $this->repository->paginate($perPage);
    }

    public function trash(int $perPage = 15)
    {
        return $this->repository->paginateTrashed($perPage);

    }

    public function create(array $attributes)
    {
        return $this->repository->create($attributes);
    }

    public function update(string $id, array $attributes)
    {
        return $this->repository->update($id, $attributes);
    }

    public function restore(string $id)
    {
        return $this->repository->restore($id);
    }
}
