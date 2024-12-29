<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\TermResource\Pages;
use App\Models\Term;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class TermResource extends Resource
{
    protected static ?string $model = Term::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?int $navigationSort = 8;

    public static function getLabel(): ?string
    {
        return trans('labels.terms');
    }

    public static function getBreadcrumb(): string
    {
        return trans('breadcrumbs.terms');
    }

    public static function getNavigationLabel(): string
    {
        return trans('menus.terms');
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
                    ->unique(Term::class, 'slug', fn ($record) => $record)
                    ->label(trans('fields.slug')),
                TinyEditor::make('content')
                    ->required()
                    ->columnSpanFull()
                    ->fileAttachmentsDisk(config('filament.default_filesystem_disk'))
                    ->fileAttachmentsDirectory('privacies')
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
                    ->content(fn (?Term $record): string => $record?->created_at?->diffForHumans() ?? '-')
                    ->label(trans('fields.created_at')),
                Forms\Components\Placeholder::make('updated_at')
                    ->content(fn (?Term $record): string => $record?->updated_at?->diffForHumans() ?? '-')
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
                    ->options(Term::pluck('id', 'id'))
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
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
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
            'index'  => Pages\ListTerms::route('/'),
            'create' => Pages\CreateTerm::route('/create'),
            'view'   => Pages\ViewTerm::route('/{record}'),
            'edit'   => Pages\EditTerm::route('/{record}/edit'),
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
