<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookReturn extends BaseModel
{
    protected $table = 'book_returns';

    protected $fillable = [
        'borrowing_id',
        'returned_date',
        'notes',
        'processed_by',
    ];

    protected function casts(): array
    {
        return [
            'returned_date' => 'date',
        ];
    }

    public function getActivityLogName(): string
    {
        return 'book_return';
    }

    public function borrowing(): BelongsTo
    {
        return $this->belongsTo(Borrowing::class);
    }

    public function processor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function items(): HasMany
    {
        return $this->hasMany(ReturnItem::class);
    }
}
