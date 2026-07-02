<?php

declare(strict_types=1);

namespace App\Support\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuid
{
    protected static function bootHasUuid(): void
    {
        static::creating(function (Model $model): void {
            $keyName = $model->getKeyName();

            if (empty($model->{$keyName})) {
                $model->{$keyName} = (string) Str::uuid();
            }
        });
    }
}
