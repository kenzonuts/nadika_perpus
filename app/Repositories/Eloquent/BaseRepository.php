<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Exceptions\NotFoundException;
use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @template TModel of Model
 *
 * @implements BaseRepositoryInterface<TModel>
 */
abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @param  TModel  $model
     */
    public function __construct(
        protected Model $model,
    ) {}

    public function find(string $id): ?Model
    {
        return $this->newQuery()->find($id);
    }

    public function findOrFail(string $id): Model
    {
        $model = $this->find($id);

        if ($model === null) {
            throw new NotFoundException(
                sprintf('%s with ID [%s] was not found.', class_basename($this->model), $id),
            );
        }

        return $model;
    }

    public function create(array $attributes): Model
    {
        return $this->newQuery()->create($attributes);
    }

    public function update(string $id, array $attributes): Model
    {
        $model = $this->findOrFail($id);
        $model->update($attributes);

        return $model->fresh() ?? $model;
    }

    public function delete(string $id): bool
    {
        $model = $this->findOrFail($id);

        return (bool) $model->delete();
    }

    public function restore(string $id): Model
    {
        if (! $this->usesSoftDeletes()) {
            throw new NotFoundException('This model does not support soft deletes.');
        }

        /** @var class-string<Model&SoftDeletes> $modelClass */
        $modelClass = $this->model::class;

        $model = $modelClass::withTrashed()->find($id);

        if ($model === null) {
            throw new NotFoundException(
                sprintf('%s with ID [%s] was not found.', class_basename($this->model), $id),
            );
        }

        $model->restore();

        return $model->fresh() ?? $model;
    }

    public function paginate(int $perPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->newQuery()->paginate($perPage, $columns);
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->newQuery()->get($columns);
    }

    protected function newQuery()
    {
        return $this->model->newQuery();
    }

    protected function usesSoftDeletes(): bool
    {
        return in_array(SoftDeletes::class, class_uses_recursive($this->model), true);
    }
}
