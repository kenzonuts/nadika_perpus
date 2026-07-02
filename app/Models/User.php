<?php

namespace App\Models;

use App\Support\Concerns\HasUuid;
use App\Support\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasRoles, HasUuid, LogsActivity, Notifiable, SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'avatar',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getActivityLogName(): string
    {
        return 'user';
    }

    public function member(): HasOne
    {
        return $this->hasOne(Member::class);
    }
}
