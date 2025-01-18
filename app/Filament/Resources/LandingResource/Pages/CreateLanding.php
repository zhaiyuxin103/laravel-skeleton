<?php

declare(strict_types=1);

namespace App\Filament\Resources\LandingResource\Pages;

use App\Filament\Resources\LandingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLanding extends CreateRecord
{
    protected static string $resource = LandingResource::class;

    protected static bool $canCreateAnother = false;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl();
    }
}
