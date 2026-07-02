<?php

namespace App\Models;

class SystemSetting extends BaseModel
{
    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    public function getActivityLogName(): string
    {
        return 'system_setting';
    }
}
