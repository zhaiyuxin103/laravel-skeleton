<?php

declare(strict_types=1);

namespace App\Models;

/**
 * @mixin IdeHelperPrivacy
 */
class Privacy extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'content',
        'state',
        'sort',
        'description',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string,string>
     */
    protected function casts(): array
    {
        return [
            'state' => 'boolean',
        ];
    }
}
