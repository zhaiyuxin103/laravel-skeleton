<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\LabelResource\Pages;
use App\Models\Label;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LabelResource extends Resource
{
    protected static ?string $model = Label::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?int $navigationSort = 1;

    public static function getLabel(): ?string
    {
        return trans('labels.labels');
    }

    public static function getBreadcrumb(): string
    {
        return trans('breadcrumbs.labels');
    }

    public static function getNavigationLabel(): string
    {
        return trans('menus.labels');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label(trans('fields.name')),
                Forms\Components\TextInput::make('slug')
                    ->maxLength(255)
                    ->label(trans('fields.slug')),
                Forms\Components\TextInput::make('used_count')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->hidden(fn (string $operation): bool => $operation !== 'view')
                    ->label(trans('fields.used_count')),
                Forms\Components\ColorPicker::make('color')
                    ->label(trans('fields.color')),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull()
                    ->label(trans('fields.description')),
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
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label(trans('fields.name')),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->label(trans('fields.slug')),
                Tables\Columns\TextColumn::make('used_count')
                    ->numeric()
                    ->sortable()
                    ->label(trans('fields.used_count')),
                Tables\Columns\TextColumn::make('color')
                    ->searchable()
                    ->label(trans('fields.color')),
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
            'index'  => Pages\ListLabels::route('/'),
            'create' => Pages\CreateLabel::route('/create'),
            'view'   => Pages\ViewLabel::route('/{record}'),
            'edit'   => Pages\EditLabel::route('/{record}/edit'),
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
