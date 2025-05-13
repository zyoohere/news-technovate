<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Illuminate\Support\Str;
use Filament\Tables\Table;
use Filament\Forms\Form;
use App\Models\Category;
use Filament\Forms\Set;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Berita';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->label('Nama Kategori')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->required(),
                TextInput::make('slug')
                    ->label('Slug')
                    ->readonly(),
                Select::make('parent_id')
                    ->label('children')
                    ->options(function () {
                        return Category::whereNull('parent_id') // hanya kategori utama
                            ->pluck('nama', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->nullable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Kategori')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('slug')
                    ->label('Slug Kategori'),
                TextColumn::make('parent.nama')->label('Parent'),


            ])
            ->filters([
                SelectFilter::make('parent_id')
                ->label('Filter Parent Kategori')
                ->options(Category::whereNull('parent_id')->pluck('nama', 'id')->toArray())
                ->searchable()
                ->placeholder('Semua Kategori')
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
