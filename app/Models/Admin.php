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
use Illuminate\Support\Facades\Storage;
use Laravel\Jetstream\HasTeams;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

/**
 * @mixin IdeHelperAdmin
 */
#[ObservedBy([AdminObserver::class])]
class Admin extends Authenticatable implements FilamentUser, HasAvatar, HasName
{
    use HasDateTimeFormatter;
    use HasFactory;
    use HasPanelShield;
    use HasPermissions;
    use HasRoles;
    use HasTeams;
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
        return $this->full_avatar;
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
