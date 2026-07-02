<?php

namespace App\Models;

use App\Enums\Gender;
use App\Enums\MemberStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'member_number',
        'phone',
        'address',
        'birth_date',
        'gender',
        'photo',
        'status',
        'joined_at',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'joined_at' => 'datetime',
            'gender' => Gender::class,
            'status' => MemberStatus::class,
        ];
    }

    public function getActivityLogName(): string
    {
        return 'member';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function borrowings(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }
}
