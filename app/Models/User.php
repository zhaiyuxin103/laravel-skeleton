<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\GenderEnum;
use App\Models\Scopes\OrderScope;
use App\Observers\UserObserver;
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
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

/**
 * @mixin IdeHelperUser
 */
#[ObservedBy([UserObserver::class])]
class User extends Authenticatable implements FilamentUser, HasAvatar, HasName
{
    use HasApiTokens;
    use HasDateTimeFormatter;
    use HasFactory;
    use HasPanelShield;
    use HasPermissions;
    use HasProfilePhoto;
    use HasRoles;
    use HasTeams;
    use Notifiable;
    use SoftDeletes;
    use TwoFactorAuthenticatable;

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
        'gender',
        'birthday',
        'age',
        'email',
        'email_verified_at',
        'phone',
        'avatar',
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
        'order',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
     * @var list<string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_admin;
    }

    public function getFilamentName(): string
    {
        return $this->name;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->full_avatar;
    }

    public function isAdmin()
    {
        return $this->is_admin;
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

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => data_get($attributes, 'first_name') . ' ' . data_get($attributes, 'last_name'),
        );
    }

    protected function alias(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => data_get($attributes, 'first_alias') . ' ' . data_get($attributes, 'last_alias'),
        );
    }

    protected function fullAvatar(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => data_get($attributes, 'avatar') ? Storage::url(data_get($attributes, 'avatar')) : null,
        );
    }
}
