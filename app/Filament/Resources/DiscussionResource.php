<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\DiscussionStatusEnum;
use App\Enums\DiscussionTypeEnum;
use App\Filament\Resources\DiscussionResource\Pages;
use App\Models\Discussion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiscussionResource extends Resource
{
    protected static ?string $model = Discussion::class;

    protected static ?string $slug = 'discussions';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left-ellipsis';

    protected static ?int $navigationSort = 5;

    public static function getLabel(): ?string
    {
        return trans('labels.discussions');
    }

    public static function getBreadcrumb(): string
    {
        return trans('breadcrumbs.discussions');
    }

    public static function getNavigationLabel(): string
    {
        return trans('menus.discussions');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\ToggleButtons::make('type')
                    ->required()
                    ->options(DiscussionTypeEnum::toSelectArray())
                    ->label(trans('fields.type')),
                Forms\Components\TextInput::make('title')
                    ->label(trans('fields.title')),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->preload()
                    ->searchable()
                    ->required()
                    ->label(trans('fields.user')),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->label(trans('fields.email')),
                Forms\Components\TextInput::make('phone')
                    ->label(trans('fields.phone')),
                Forms\Components\Textarea::make('content')
                    ->required()
                    ->rows(5)
                    ->columnSpanFull()
                    ->label(trans('fields.content')),
                Forms\Components\ToggleButtons::make('status')
                    ->required()
                    ->options(DiscussionStatusEnum::toSelectArray())
                    ->label(trans('fields.status')),
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
                    ->content(fn (?Discussion $record): string => $record?->created_at?->diffForHumans() ?? '-')
                    ->label(trans('fields.created_at')),
                Forms\Components\Placeholder::make('updated_at')
                    ->content(fn (?Discussion $record): string => $record?->updated_at?->diffForHumans() ?? '-')
                    ->label(trans('fields.updated_at')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('format_type')
                    ->label(trans('fields.type')),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(isIndividual: true)
                    ->sortable()
                    ->label(trans('fields.title')),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(isIndividual: true)
                    ->sortable()
                    ->label(trans('fields.user')),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(isIndividual: true)
                    ->sortable()
                    ->label(trans('fields.email')),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(isIndividual: true)
                    ->label(trans('fields.phone')),
                Tables\Columns\TextColumn::make('format_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        DiscussionStatusEnum::PENDING->description() => 'info',
                        default                                      => 'gray',
                    })
                    ->label(trans('fields.status')),
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
                Tables\Filters\SelectFilter::make('type')
                    ->options(DiscussionTypeEnum::toSelectArray())
                    ->label(trans('fields.type')),
                Tables\Filters\SelectFilter::make('status')
                    ->options(DiscussionStatusEnum::toSelectArray())
                    ->label(trans('fields.status')),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListDiscussions::route('/'),
            'create' => Pages\CreateDiscussion::route('/create'),
            'view'   => Pages\ViewDiscussion::route('/{record}'),
            'edit'   => Pages\EditDiscussion::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['user']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'email', 'user.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];
        assert($record instanceof Discussion);
        if ($record->user) {
            $details['User'] = $record->user->name;
        }

        return $details;
    }
}
