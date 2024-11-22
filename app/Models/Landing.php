<?php

declare(strict_types=1);

namespace App\Models;

/**
 * @mixin IdeHelperLanding
 */
class Landing extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'content',
        'state',
        'sort',
    ];

    protected function casts(): array
    {
        return [
            'state' => 'boolean',
        ];
    }
}
