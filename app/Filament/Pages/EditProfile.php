<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Enums\GenderEnum;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Illuminate\Validation\Rules\Unique;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(255)
                    ->label(trans('fields.first_name')),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(255)
                    ->label(trans('fields.last_name')),
                Forms\Components\TextInput::make('first_alias')
                    ->maxLength(255)
                    ->label(trans('fields.first_alias')),
                Forms\Components\TextInput::make('last_alias')
                    ->maxLength(255)
                    ->label(trans('fields.last_alias')),
                Forms\Components\TextInput::make('email')
                    ->label(__('filament-panels::pages/auth/edit-profile.form.email.label'))
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true, modifyRuleUsing: function (Unique $rule) {
                        return $rule->whereNull('deleted_at');
                    }),
                Forms\Components\TextInput::make('phone')
                    ->maxLength(255)
                    ->label(trans('fields.phone')),
                Forms\Components\SpatieMediaLibraryFileUpload::make('avatar')
                    ->collection('avatar')
                    ->image()
                    ->imageEditor()
                    ->moveFiles()
                    ->label(trans('fields.avatar')),
                Forms\Components\Select::make('gender')
                    ->required()
                    ->options(GenderEnum::toSelectArray())
                    ->label(trans('fields.gender')),
                Forms\Components\DatePicker::make('birthday')
                    ->displayFormat('Y-m-d')
                    ->placeholder(trans('placeholders.birthday'))
                    ->label(trans('fields.birthday')),
                Forms\Components\TextInput::make('age')
                    ->numeric()
                    ->hidden(fn (string $operation): bool => $operation !== 'view')
                    ->label(trans('fields.age')),
                Forms\Components\RichEditor::make('introduction')
                    ->columnSpanFull()
                    ->label(trans('fields.introduction')),
            ])
            ->columns()
            ->inlineLabel(false);
    }
}
