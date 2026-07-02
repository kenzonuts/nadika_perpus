<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\BookRepositoryInterface;

class BookService extends BaseService
{
    public function __construct(public readonly BookRepositoryInterface $repository) {}

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
        $attributes['available_stock'] = $attributes['stock'] ?? 0;
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

    public function forceDelete(string $id): bool
    {
        $book = $this->repository->findOrFail($id);

        return (bool) $book->forceDelete();
    }
}
