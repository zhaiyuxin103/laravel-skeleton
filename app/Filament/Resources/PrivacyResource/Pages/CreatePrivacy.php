<?php

declare(strict_types=1);

namespace App\Filament\Resources\PrivacyResource\Pages;

use App\Filament\Resources\PrivacyResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePrivacy extends CreateRecord
{
    protected static string $resource = PrivacyResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl();
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        data_set($data, 'user_id', auth()->guard('admin')->id());

        return $data;
    }
}
