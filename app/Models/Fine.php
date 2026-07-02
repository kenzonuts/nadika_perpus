<?php

namespace App\Models;

use App\Enums\FineStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fine extends BaseModel
{
    protected $fillable = [
        'borrowing_item_id',
        'amount',
        'reason',
        'status',
        'paid_at',
        'waived_by',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'status' => FineStatus::class,
            'paid_at' => 'datetime',
        ];
    }

    public function getActivityLogName(): string
    {
        return 'fine';
    }

    public function borrowingItem(): BelongsTo
    {
        return $this->belongsTo(BorrowingItem::class);
    }

    public function waivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'waived_by');
    }
}
