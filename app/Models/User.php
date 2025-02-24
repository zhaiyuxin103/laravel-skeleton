<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\GenderEnum;
use App\Models\Scopes\OrderScope;
use App\Observers\UserObserver;
use App\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

/**
 * @mixin IdeHelperUser
 */
#[ObservedBy([UserObserver::class])]
class User extends Authenticatable
{
    use HasApiTokens;
    use HasDateTimeFormatter;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Impersonate;
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
