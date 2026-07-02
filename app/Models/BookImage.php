<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookImage extends BaseModel
{
    protected $fillable = [
        'book_id',
        'path',
        'is_primary',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_primary' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function getActivityLogName(): string
    {
        return 'book_image';
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
