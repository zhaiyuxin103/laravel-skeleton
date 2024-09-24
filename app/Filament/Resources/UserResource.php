<?php

namespace App\Filament\Resources;

use App\Enums\GenderEnum;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 5;

    public static function getLabel(): ?string
    {
        return trans('labels.users');
    }

    public static function getBreadcrumb(): string
    {
        return trans('breadcrumbs.users');
    }

    public static function getNavigationLabel(): string
    {
        return trans('menus.users');
    }

    public static function form(Form $form): Form
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
                Forms\Components\Select::make('gender')
                    ->required()
                    ->options(GenderEnum::toSelectArray())
                    ->label(trans('fields.gender')),
                Forms\Components\DatePicker::make('birthday')
                    ->label(trans('fields.birthday')),
                Forms\Components\TextInput::make('age')
                    ->numeric()
                    ->hidden(fn (string $operation): bool => $operation !== 'view')
                    ->label(trans('fields.age')),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->label(trans('fields.email')),
                Forms\Components\TextInput::make('phone')
                    ->maxLength(255)
                    ->label(trans('fields.phone')),
                Forms\Components\FileUpload::make('avatar')
                    ->image()
                    ->imageEditor()
                    ->directory('uploads/images/users/avatars')
                    ->moveFiles()
                    ->label(trans('fields.avatar')),
                Forms\Components\TextInput::make('zip')
                    ->maxLength(255)
                    ->label(trans('fields.zip')),
                Forms\Components\TextInput::make('address')
                    ->maxLength(255)
                    ->label(trans('fields.address')),
                Forms\Components\RichEditor::make('introduction')
                    ->columnSpanFull()
                    ->label(trans('fields.introduction')),
                Forms\Components\TextInput::make('notification_count')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->hidden(fn (string $operation): bool => $operation !== 'view')
                    ->label(trans('fields.notification_count')),
                Forms\Components\DateTimePicker::make('last_authed_at')
                    ->hidden(fn (string $operation): bool => $operation !== 'view')
                    ->label(trans('fields.last_authed_at')),
                Forms\Components\DateTimePicker::make('last_actived_at')
                    ->hidden(fn (string $operation): bool => $operation !== 'view')
                    ->label(trans('fields.last_actived_at')),
                Forms\Components\Toggle::make('is_admin')
                    ->required()
                    ->label(trans('fields.is_admin')),
                Forms\Components\Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->label(trans('fields.role')),
                Forms\Components\Section::make()
                    ->columns(2)
                    ->schema([
                        Forms\Components\Toggle::make('state')
                            ->required()
                            ->default(true)
                            ->label(trans('fields.state')),
                        Forms\Components\TextInput::make('order')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->label(trans('fields.order')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label(trans('fields.name')),
                Tables\Columns\TextColumn::make('alias')
                    ->searchable()
                    ->label(trans('fields.alias')),
                Tables\Columns\TextColumn::make('format_gender')
                    ->numeric()
                    ->sortable()
                    ->label(trans('fields.gender')),
                Tables\Columns\TextColumn::make('birthday')
                    ->date('Y-m-d')
                    ->sortable()
                    ->label(trans('fields.birthday')),
                Tables\Columns\TextColumn::make('age')
                    ->numeric()
                    ->sortable()
                    ->label(trans('fields.age')),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label(trans('fields.email')),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->label(trans('fields.phone')),
                Tables\Columns\ImageColumn::make('avatar')
                    ->searchable()
                    ->label(trans('fields.avatar')),
                Tables\Columns\TextColumn::make('zip')
                    ->searchable()
                    ->label(trans('fields.zip')),
                Tables\Columns\TextColumn::make('address')
                    ->searchable()
                    ->label(trans('fields.address')),
                Tables\Columns\IconColumn::make('is_admin')
                    ->boolean()
                    ->label(trans('fields.is_admin')),
                Tables\Columns\TextColumn::make('notification_count')
                    ->numeric()
                    ->sortable()
                    ->label(trans('fields.notification_count')),
                Tables\Columns\TextColumn::make('last_authed_at')
                    ->dateTime()
                    ->sortable()
                    ->label(trans('fields.last_authed_at')),
                Tables\Columns\TextColumn::make('last_actived_at')
                    ->dateTime()
                    ->sortable()
                    ->label(trans('fields.last_actived_at')),
                Tables\Columns\IconColumn::make('state')
                    ->boolean()
                    ->label(trans('fields.state')),
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable()
                    ->label(trans('fields.order')),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
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