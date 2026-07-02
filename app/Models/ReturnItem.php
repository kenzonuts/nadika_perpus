<?php

namespace App\Models;

use App\Enums\BookReturnCondition;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReturnItem extends BaseModel
{
    protected $fillable = [
        'book_return_id',
        'borrowing_item_id',
        'condition',
        'late_days',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'condition' => BookReturnCondition::class,
            'late_days' => 'integer',
        ];
    }

    public function getActivityLogName(): string
    {
        return 'return_item';
    }

    public function bookReturn(): BelongsTo
    {
        return $this->belongsTo(BookReturn::class);
    }

    public function borrowingItem(): BelongsTo
    {
        return $this->belongsTo(BorrowingItem::class);
    }
}
