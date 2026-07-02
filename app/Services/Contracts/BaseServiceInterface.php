<?php

declare(strict_types=1);

namespace App\Services\Contracts;

interface BaseServiceInterface
{
    /**
     * @template TReturn
     *
     * @param  callable(): TReturn  $callback
     * @return TReturn
     */
    public function transaction(callable $callback): mixed;
}
