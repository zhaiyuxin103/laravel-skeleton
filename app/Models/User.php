<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\GenderEnum;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Scopes\OrderScope;
use App\Observers\UserObserver;
use App\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @mixin IdeHelperUser
 */
#[ObservedBy([UserObserver::class])]
class User extends Authenticatable implements HasMedia
{
    use HasApiTokens;
    use HasDateTimeFormatter;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Impersonate;
    use InteractsWithMedia;
    use Notifiable;
    use SoftDeletes;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'first_alias',
        'last_alias',
        'gender',
        'birthday',
        'age',
        'email',
        'email_verified_at',
        'phone',
        'password',
        'zip',
        'address',
        'is_admin',
        'introduction',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
        'remember_token',
        'current_team_id',
        'profile_photo_path',
        'ip',
        'method',
        'path',
        'url',
        'browser',
        'browser_version',
        'languages',
        'engine',
        'os',
        'os_alias',
        'device',
        'device_manufacturer',
        'device_model',
        'notification_count',
        'last_authed_at',
        'last_actived_at',
        'state',
        'sort',
        'created_at',
        'updated_at',
        'deleted_at',
        'name',
        'alias',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function canImpersonate(): bool
    {
        return true;
    }

    public function canBeImpersonated(): bool
    {
        return true;
    }

    public function abouts(): HasMany
    {
        return $this->hasMany(About::class);
    }

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

    /**
     * Update the user's profile photo.
     *
     * @param  string  $storagePath
     * @return void
     */
    public function updateProfilePhoto(UploadedFile $photo, $storagePath = 'profile-photos')
    {
        $path = $photo->storePublicly(
            $storagePath, ['disk' => $this->profilePhotoDisk()]
        );
        $this->addMediaFromDisk($path, config('filesystems.default'))->toMediaCollection('avatar');
    }

    public function defaultProfilePhotoUrl(): string
    {
        $name = trim(collect(explode(' ', (string) $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=' . trim(config('app.color'), '#') . '&background=3ea2a812';
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new OrderScope);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'gender'            => 'integer',
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_admin'          => 'boolean',
        ];
    }

    protected function formatGender(): Attribute
    {
        return new Attribute(
            get: fn (mixed $value, array $attributes) => data_get($attributes, 'gender') ? data_get(GenderEnum::toSelectArray(), data_get($attributes, 'gender')) : null,
        );
    }
}
