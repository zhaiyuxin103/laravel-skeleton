<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\GenderEnum;
use App\Filament\Resources\AdminResource\Pages;
use App\Models\Admin;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 5;

    public static function getLabel(): ?string
    {
        return trans('labels.admins');
    }

    public static function getBreadcrumb(): string
    {
        return trans('breadcrumbs.admins');
    }

    public static function getNavigationLabel(): string
    {
        return trans('menus.admins');
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
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->label(trans('fields.email')),
                Forms\Components\TextInput::make('phone')
                    ->maxLength(255)
                    ->label(trans('fields.phone')),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->maxLength(255)
                    ->label(trans('fields.password')),
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
                        Forms\Components\TextInput::make('sort')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->label(trans('fields.sort')),
                    ]),
                Forms\Components\Placeholder::make('created_at')
                    ->content(fn (?Admin $record): string => $record?->created_at?->diffForHumans() ?? '-')
                    ->label(trans('fields.created_at')),
                Forms\Components\Placeholder::make('updated_at')
                    ->content(fn (?Admin $record): string => $record?->updated_at?->diffForHumans() ?? '-')
                    ->label(trans('fields.updated_at')),
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
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label(trans('fields.name')),
                Tables\Columns\TextColumn::make('alias')
                    ->searchable()
                    ->label(trans('fields.alias')),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label(trans('fields.email')),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->label(trans('fields.phone')),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('avatar')
                    ->collection('avatar')
                    ->circular()
                    ->label(trans('fields.avatar')),
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
                Tables\Filters\SelectFilter::make('id')
                    ->options(Admin::where('state', true)->pluck('id', 'id'))
                    ->searchable()
                    ->label(trans('fields.id')),
                Tables\Filters\SelectFilter::make('gender')
                    ->options(GenderEnum::toSelectArray())
                    ->label(trans('fields.gender')),
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
            'index'  => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'view'   => Pages\ViewAdmin::route('/{record}'),
            'edit'   => Pages\EditAdmin::route('/{record}/edit'),
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
