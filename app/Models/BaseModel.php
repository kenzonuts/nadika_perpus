<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\Concerns\HasUuid;
use App\Support\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class BaseModel extends Model
{
    use HasFactory;
    use HasUuid;
    use LogsActivity;
    use SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    abstract public function getActivityLogName(): string;
}
