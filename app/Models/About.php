<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperAbout
 */
class About extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'content',
        'state',
        'sort',
        'user_id',
        'description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'state' => 'boolean',
        ];
    }
}
