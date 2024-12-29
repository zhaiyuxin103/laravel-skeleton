<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\DiscussionStatusEnum;
use App\Enums\DiscussionTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperDiscussion
 */
class Discussion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'type',
        'name',
        'title',
        'user_id',
        'email',
        'phone',
        'file_id',
        'content',
        'status',
        'state',
        'sort',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function formatStatus(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => DiscussionStatusEnum::fromValue(data_get($attributes, 'status'))->description(),
        );
    }

    protected function formatType(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => DiscussionTypeEnum::fromValue(data_get($attributes, 'type'))->description(),
        );
    }

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
