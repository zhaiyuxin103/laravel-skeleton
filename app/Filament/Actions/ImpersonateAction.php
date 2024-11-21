<?php

declare(strict_types=1);

namespace App\Filament\Actions;

use App\Models\User;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class ImpersonateAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label(trans('Impersonate this user'));

        $this->icon('heroicon-o-user');

        $this->url(function (Model $record): string {
            assert($record instanceof User);

            return route('impersonate', $record->id);
        });
    }
}
