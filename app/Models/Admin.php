<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\GenderEnum;
use App\Observers\AdminObserver;
use App\Traits\HasDateTimeFormatter;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Jetstream\HasTeams;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

/**
 * @mixin IdeHelperAdmin
 */
#[ObservedBy([AdminObserver::class])]
class Admin extends Authenticatable implements FilamentUser, HasAvatar, HasMedia, HasName
{
    use HasDateTimeFormatter;
    use HasFactory;
    use HasPanelShield;
    use HasPermissions;
    use HasRoles;
    use HasTeams;
    use InteractsWithMedia;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'first_alias',
        'last_alias',
        'email',
        'phone',
        'password',
        'gender',
        'birthday',
        'age',
        'introduction',
        'state',
        'sort',
        'name',
        'alias',
    ];

    public function registerMediaCollections(): void
    {
        foreach (['avatar'] as $value) {
            if (in_array($value, ['avatar'])) {
                $this->addMediaCollection($value)
                    ->singleFile()
                    ->useFallbackPath($this->defaultProfilePhotoUrl());
            } else {
                $this->addMediaCollection($value);
            }
        }
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        foreach (Cache::get('thumbnail') as $thumbnail) {
            $this->addMediaConversion((string) $thumbnail)
                ->fit(Fit::Contain, $thumbnail, $thumbnail)
                ->quality(100);
        }
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function getFilamentName(): string
    {
        return $this->name;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->getFirstMediaUrl('avatar');
    }

    public function defaultProfilePhotoUrl(): string
    {
        $name = trim(collect(explode(' ', (string) $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=' . trim(config('app.color'), '#') . '&background=3ea2a812';
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'gender'   => 'integer',
            'password' => 'hashed',
            'state'    => 'boolean',
        ];
    }

    protected function formatGender(): Attribute
    {
        return new Attribute(
            get: fn (mixed $value, array $attributes) => data_get($attributes, 'gender') ? data_get(GenderEnum::toSelectArray(), data_get($attributes, 'gender')) : null,
        );
    }
}
