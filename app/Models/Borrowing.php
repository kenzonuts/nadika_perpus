<?php

namespace App\Models;

use App\Enums\BorrowingStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Borrowing extends BaseModel
{
    protected $fillable = [
        'member_id',
        'borrow_number',
        'borrow_date',
        'due_date',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'borrow_date' => 'date',
            'due_date' => 'date',
            'status' => BorrowingStatus::class,
        ];
    }

    public function getActivityLogName(): string
    {
        return 'borrowing';
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(BorrowingItem::class);
    }

    public function bookReturns(): HasMany
    {
        return $this->hasMany(BookReturn::class);
    }
}
