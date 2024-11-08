<?php

declare(strict_types=1);

namespace App\Models;

/**
 * @mixin IdeHelperVerificationCode
 */
class VerificationCode extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'email',
        'phone',
        'code',
        'type',
        'user_id',
        'expired_at',
        'used_at',
        'state',
        'sort',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'expired_at' => 'datetime',
            'used_at'    => 'datetime',
        ];
    }
}
