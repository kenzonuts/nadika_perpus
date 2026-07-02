<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shelf extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'location',
        'description',
    ];

    public function getActivityLogName(): string
    {
        return 'shelf';
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
