<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 */
interface BaseRepositoryInterface
{
    /**
     * @return TModel|null
     */
    public function find(string $id): ?Model;

    /**
     * @return TModel
     */
    public function findOrFail(string $id): Model;

    /**
     * @param  array<string, mixed>  $attributes
     * @return TModel
     */
    public function create(array $attributes): Model;

    /**
     * @param  array<string, mixed>  $attributes
     * @return TModel
     */
    public function update(string $id, array $attributes): Model;

    public function delete(string $id): bool;

    /**
     * @return TModel
     */
    public function restore(string $id): Model;

    /**
     * @return LengthAwarePaginator<int, TModel>
     */
    public function paginate(int $perPage = 15, array $columns = ['*']): LengthAwarePaginator;

    /**
     * @return Collection<int, TModel>
     */
    public function all(array $columns = ['*']): Collection;
}
