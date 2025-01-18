<?php

declare(strict_types=1);

namespace App\Filament\Resources\VerificationCodeResource\Pages;

use App\Filament\Resources\VerificationCodeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVerificationCode extends CreateRecord
{
    protected static string $resource = VerificationCodeResource::class;

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl();
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['key'] = 'verification_code_' . data_get($data, 'type') . '_' . data_get($data, 'key');

        return $data;
    }
}
