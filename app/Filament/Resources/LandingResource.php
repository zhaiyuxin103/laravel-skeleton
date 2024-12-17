<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\LandingResource\Pages;
use App\Models\Landing;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class LandingResource extends Resource
{
    protected static ?string $model = Landing::class;

    protected static ?string $slug = 'landings';

    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';

    protected static ?int $navigationSort = 1;

    public static function getLabel(): ?string
    {
        return trans('labels.landings');
    }

    public static function getBreadcrumb(): string
    {
        return trans('breadcrumbs.landings');
    }

    public static function getNavigationLabel(): string
    {
        return trans('menus.landings');
    }

    public static function getNavigationGroup(): ?string
    {
        return trans('labels.texts');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                    ->label(trans('fields.name')),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255)
                    ->label(trans('fields.description')),
                Forms\Components\TextInput::make('slug')
                    ->readOnly()
                    ->required()
                    ->maxLength(255)
                    ->unique(Landing::class, 'slug', fn ($record) => $record)
                    ->label(trans('fields.slug')),
                TinyEditor::make('content')
                    ->columnSpanFull()
                    ->fileAttachmentsDisk(config('filament.default_filesystem_disk'))
                    ->fileAttachmentsDirectory('landings')
                    ->required()
                    ->label(trans('fields.content')),
                Forms\Components\Section::make()
                    ->columns()
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
                    ->label('Created Date')
                    ->content(fn (?Landing $record): string => $record?->created_at?->diffForHumans() ?? '-')
                    ->label(trans('fields.created_at')),
                Forms\Components\Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn (?Landing $record): string => $record?->updated_at?->diffForHumans() ?? '-')
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
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(trans('fields.id')),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(isIndividual: true)
                    ->label(trans('fields.name')),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(isIndividual: true)
                    ->label(trans('fields.description')),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(isIndividual: true)
                    ->copyable()
                    ->icon('heroicon-o-clipboard-document')
                    ->iconPosition(IconPosition::After)
                    ->label(trans('fields.slug')),
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
                    ->options(Landing::pluck('id', 'id'))
                    ->searchable()
                    ->label(trans('fields.id')),
                Tables\Filters\TernaryFilter::make('state')
                    ->label(trans('fields.state')),
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

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListLandings::route('/'),
            'create' => Pages\CreateLanding::route('/create'),
            'view'   => Pages\ViewLanding::route('/{record}'),
            'edit'   => Pages\EditLanding::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'slug'];
    }
}
