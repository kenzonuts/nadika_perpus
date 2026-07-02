<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Contracts\BaseServiceInterface;
use Illuminate\Support\Facades\DB;
use Throwable;

class BaseService implements BaseServiceInterface
{
    public function transaction(callable $callback): mixed
    {
        return DB::transaction(static function () use ($callback) {
            return $callback();
        });
    }

    /**
     * @template TReturn
     *
     * @param  callable(): TReturn  $callback
     * @return TReturn
     *
     * @throws Throwable
     */
    protected function runInTransaction(callable $callback): mixed
    {
        return $this->transaction($callback);
    }
}
