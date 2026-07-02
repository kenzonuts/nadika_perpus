<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function getActivityLogName(): string
    {
        return 'category';
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
