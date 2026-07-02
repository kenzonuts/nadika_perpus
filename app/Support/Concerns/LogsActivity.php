<?php

declare(strict_types=1);

namespace App\Support\Concerns;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity as SpatieLogsActivity;

trait LogsActivity
{
    use SpatieLogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName($this->getActivityLogName())
            ->dontSubmitEmptyLogs();
    }

    abstract public function getActivityLogName(): string;
}
