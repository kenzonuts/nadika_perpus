<?php

namespace App\Models;

use App\Enums\BorrowingItemStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BorrowingItem extends BaseModel
{
    protected $fillable = [
        'borrowing_id',
        'book_id',
        'quantity',
        'status',
        'returned_at',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'status' => BorrowingItemStatus::class,
            'returned_at' => 'datetime',
        ];
    }

    public function getActivityLogName(): string
    {
        return 'borrowing_item';
    }

    public function borrowing(): BelongsTo
    {
        return $this->belongsTo(Borrowing::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function returnItem(): HasOne
    {
        return $this->hasOne(ReturnItem::class);
    }

    public function fine(): HasOne
    {
        return $this->hasOne(Fine::class);
    }
}
