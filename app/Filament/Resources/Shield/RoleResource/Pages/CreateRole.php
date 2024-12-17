<?php

declare(strict_types=1);

namespace App\Filament\Resources\Shield\RoleResource\Pages;

use App\Filament\Resources\Shield\RoleResource;
use App\Models\Role;
use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class CreateRole extends CreateRecord
{
    public Collection $permissions;

    protected static string $resource = RoleResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl();
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->permissions = collect($data)
            ->filter(function ($permission, $key) {
                return ! in_array($key, ['name', 'guard_name', 'select_all']);
            })
            ->values()
            ->flatten()
            ->unique();

        return Arr::only($data, ['name', 'guard_name', 'description', 'state', 'sort']);
    }

    protected function afterCreate(): void
    {
        $permissionModels = collect();
        $this->permissions->each(function ($permission) use ($permissionModels) {
            $permissionModels->push(Utils::getPermissionModel()::firstOrCreate([
                /** @phpstan-ignore-next-line */
                'name'       => $permission,
                'guard_name' => $this->data['guard_name'],
            ]));
        });

        /** @var Role $record */
        $record = $this->record;
        $record->syncPermissions($permissionModels);
    }
}
