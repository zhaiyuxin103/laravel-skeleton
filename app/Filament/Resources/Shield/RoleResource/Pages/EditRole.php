<?php

declare(strict_types=1);

namespace App\Filament\Resources\Shield\RoleResource\Pages;

use App\Filament\Resources\Shield\RoleResource;
use App\Models\Role;
use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class EditRole extends EditRecord
{
    public Collection $permissions;

    protected static string $resource = RoleResource::class;

    public function getHeading(): string
    {
        /** @var Role $record */
        $record = $this->record;

        return $record->description ?? $record->name;
    }

    public function getBreadcrumbs(): array
    {
        /** @var Role $record */
        $record = $this->record;

        return [
            route('filament.admin.resources.shield.roles.index') => __('filament-shield::filament-shield.nav.role.label'),
            route('filament.admin.resources.shield.roles.view', [
                'record' => $record,
            ])  => $record->description ?? $record->name,
            '#' => __('filament-panels::resources/pages/edit-record.breadcrumb'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->getRecord()]);
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->permissions = collect($data)
            ->filter(function ($permission, $key) {
                return ! in_array($key, ['name', 'guard_name', 'select_all']);
            })
            ->values()
            ->flatten()
            ->unique();

        return Arr::only($data, ['name', 'guard_name', 'description', 'state', 'order']);
    }

    protected function afterSave(): void
    {
        $permissionModels = collect();
        $this->permissions->each(function ($permission) use ($permissionModels) {
            $permissionModels->push(Utils::getPermissionModel()::firstOrCreate([
                'name'       => $permission,
                'guard_name' => $this->data['guard_name'],
            ]));
        });

        /** @var Role $record */
        $record = $this->record;
        $record->syncPermissions($permissionModels);
    }
}
