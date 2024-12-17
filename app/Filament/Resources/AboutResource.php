<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\AboutResource\Pages;
use App\Models\About;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $slug = 'abouts';

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static ?int $navigationSort = 2;

    public static function getLabel(): ?string
    {
        return trans('labels.abouts');
    }

    public static function getBreadcrumb(): string
    {
        return trans('breadcrumbs.abouts');
    }

    public static function getNavigationLabel(): string
    {
        return trans('menus.abouts');
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
                    ->unique(About::class, 'slug', fn ($record) => $record)
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
                    ->content(fn (?About $record): string => $record?->created_at?->diffForHumans() ?? '-')
                    ->label(trans('fields.created_at')),
                Forms\Components\Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn (?About $record): string => $record?->updated_at?->diffForHumans() ?? '-')
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
                    ->options(About::pluck('id', 'id'))
                    ->searchable()
                    ->label(trans('fields.id')),
                Tables\Filters\SelectFilter::make('user_id')
                    ->options(User::pluck('id', 'id'))
                    ->searchable()
                    ->label(trans('fields.user')),
                Tables\Filters\TernaryFilter::make('state')
                    ->label(trans('fields.state')),
                TrashedFilter::make(),
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

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'view'   => Pages\ViewAbout::route('/{record}'),
            'edit'   => Pages\EditAbout::route('/{record}/edit'),
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
        return ['name', 'slug', 'user.name'];
    }

    /**
     * @param  Model&About  $record
     * @return array|string[]
     */
    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->user) {
            $details['User'] = $record->user->name;
        }

        return $details;
    }
}
