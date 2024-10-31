<?php

declare(strict_types=1);

namespace App\Models;

/**
 * @mixin IdeHelperLabel
 */
class Label extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'color',
        'description',
        'state',
        'order',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'state' => 'boolean',
        ];
    }
}
