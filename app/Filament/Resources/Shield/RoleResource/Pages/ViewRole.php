<?php

declare(strict_types=1);

namespace App\Filament\Resources\Shield\RoleResource\Pages;

use App\Filament\Resources\Shield\RoleResource;
use App\Models\Role;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRole extends ViewRecord
{
    protected static string $resource = RoleResource::class;

    public function getHeading(): string
    {
        /** @var Role $record */
        $record = $this->record;

        return $record->description;
    }

    public function getBreadcrumbs(): array
    {
        /** @var Role $record */
        $record = $this->record;

        return [
            route('filament.admin.resources.shield.roles.index') => __('filament-shield::filament-shield.nav.role.label'),
            route('filament.admin.resources.shield.roles.edit', [
                'record' => $record,
            ])  => $record->description,
            '#' => __('filament-panels::resources/pages/edit-record.breadcrumb'),
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
