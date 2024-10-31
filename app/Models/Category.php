<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\CategoryObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperCategory
 */
#[ObservedBy([CategoryObserver::class])]
class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name', 'is_directory', 'level', 'path', 'state', 'order', 'parent_id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var list<string>
     */
    protected $appends = ['path_ids', 'ancestors', 'full_name'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_directory' => 'boolean',
            'state'        => 'boolean',
        ];
    }

    /**
     * 定义一个访问器，获取所有祖先类目的 ID 值
     *
     * @return Attribute<Category, never>
     */
    protected function pathIds(): Attribute
    {
        return Attribute::make(
            // trim($string, '-') 将字符串两端的 - 符号去除
            // explode() 将字符串以 - 为分隔切割为数组
            // 最后 array_filter 将数组中的空值去除
            get: fn ($value) => array_filter(explode('-', trim($this->path, '-'))),
        );
    }

    /**
     * 定义一个访问器，获取所有祖先类目并按层级排序
     *
     * @return Attribute<Category, never>
     */
    protected function ancestors(): Attribute
    {
        return Attribute::make(
            // 使用上面的访问器获取所有祖先类目 ID
            // 按层级排序
            get: fn ($value) => Category::query()->where('id', $this->path_ids)->orderBy('level')->get(),
        );
    }

    // 定义一个访问器，获取以 - 为分隔的所有祖先类目名称以及当前类目的名称
    protected function fullName(): Attribute
    {
        return Attribute::make(
            // 获取所有祖先类目
            // 取出所有祖先类目的 name 字段作为一个数组
            // 将当前类目的 name 字段值加到数组的末尾
            // 用 - 符号将数组的值组装成一个字符串
            get: fn ($value) => $this->ancestors->pluck('name')->push($this->name)->implode(' - '),
        );
    }
}
