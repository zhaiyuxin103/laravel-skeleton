<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\VerificationCodeEnum;
use App\Filament\Resources\VerificationCodeResource\Pages;
use App\Models\VerificationCode;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Random\RandomException;

class VerificationCodeResource extends Resource
{
    protected static ?string $model = VerificationCode::class;

    protected static ?string $navigationIcon = 'heroicon-o-code-bracket-square';

    protected static ?int $navigationSort = 3;

    public static function getLabel(): ?string
    {
        return trans('labels.verification_codes');
    }

    public static function getBreadcrumb(): string
    {
        return trans('labels.verification_codes');
    }

    public static function getNavigationLabel(): string
    {
        return trans('labels.verification_codes');
    }

    /**
     * @throws RandomException
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->default(Str::random(15))
                    ->readOnly()
                    ->maxLength(255)
                    ->label(trans('fields.verification_code.key')),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255)
                    ->label(trans('fields.email')),
                Forms\Components\TextInput::make('phone')
                    ->maxLength(255)
                    ->label(trans('fields.phone')),
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->numeric()
                    ->default(Str::padLeft((string) random_int(1, 999999), 6, '0'))
                    ->readOnly()
                    ->maxLength(255)
                    ->label(trans('fields.verification_code.code')),
                Forms\Components\Select::make('type')
                    ->required()
                    ->options(VerificationCodeEnum::toSelectArray())
                    ->live()
                    ->label(trans('fields.verification_code.type')),
                Forms\Components\TextInput::make('user_id')
                    ->numeric()
                    ->label(trans('fields.user')),
                Forms\Components\DateTimePicker::make('expired_at')
                    ->label(trans('fields.expired_at')),
                Forms\Components\DateTimePicker::make('used_at')
                    ->label(trans('fields.used_at')),
                Forms\Components\Section::make()
                    ->columns(2)
                    ->schema([
                        Forms\Components\Toggle::make('state')
                            ->required()
                            ->default(true)
                            ->label(trans('fields.state')),
                        Forms\Components\TextInput::make('sort')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->label(trans('fields.sort')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')
                    ->rowIndex()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(trans('fields.index')),
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->searchable()
                    ->label(trans('fields.id')),
                Tables\Columns\TextColumn::make('key')
                    ->searchable()
                    ->label(trans('fields.verification_code.key')),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label(trans('fields.email')),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->label(trans('fields.phone')),
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->label(trans('fields.verification_code.code')),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        VerificationCodeEnum::REGISTER->value => 'warning',
                        default                               => 'primary',
                    })
                    ->searchable()
                    ->label(trans('fields.verification_code.type')),
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable()
                    ->label(trans('fields.user')),
                Tables\Columns\TextColumn::make('expired_at')
                    ->dateTime()
                    ->sortable()
                    ->label(trans('fields.expired_at')),
                Tables\Columns\TextColumn::make('used_at')
                    ->dateTime()
                    ->sortable()
                    ->label(trans('fields.used_at')),
                Tables\Columns\IconColumn::make('state')
                    ->boolean()
                    ->label(trans('fields.state')),
                Tables\Columns\TextColumn::make('sort')
                    ->numeric()
                    ->sortable()
                    ->label(trans('fields.sort')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(trans('fields.created_at')),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(trans('fields.updated_at')),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(trans('fields.deleted_at')),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListVerificationCodes::route('/'),
            'create' => Pages\CreateVerificationCode::route('/create'),
            'view'   => Pages\ViewVerificationCode::route('/{record}'),
            'edit'   => Pages\EditVerificationCode::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
