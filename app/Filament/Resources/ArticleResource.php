<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use App\Models\Category;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Filament\Forms\Components\Section as FormSection;
use Filament\Infolists\Components\Section as InfolistsSection;
use Filament\Forms\Components\Fieldset;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Support\Str;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section;
class ArticleResource extends Resource{
   protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Berita';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FormSection::make([
                    TextInput::make('title')
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (?string $state, Get $get, Set $set) {
                            if (blank($get('slug'))) {
                                $set('slug', Str::slug($get('title')));
                            }
                        })
                        ->maxLength(255)
                        ->required(),
                    TextInput::make('slug')
                        ->label('Slug')
                        ->readOnly(),
                    Select::make('category_id')
                        ->label('Nama Katergori')
                        ->preload()
                        ->options(
                            Category::whereNotNull('parent_id')->pluck('nama', 'id')
                        )
                        ->searchable()
                        ->required(),
                    RichEditor::make('content')
                        ->label('Konten Artikel')
                        ->required()
                        ->toolbarButtons([
                            'bold',
                            'italic',
                            'underline',
                            'strike',
                            'codeBlock',
                            'blockquote',
                            'bulletedList',
                            'numberedList',
                            'link',
                        ]),
                ])->columnSpan(2),
                FormSection::make([
                    Select::make('user_id')
                        ->label('Nama Penulis')
                        ->relationship(
                            name: 'user',
                            titleAttribute: 'nama',
                            modifyQueryUsing: fn($query) => $query->where('role', 'author')
                        )
                        ->preload()
                        ->searchable()
                        ->required(),
                    DateTimePicker::make('created_at')
                        ->label('Tanggal Dibuat')
                        ->disabled()
                        ->hiddenOn('create')
                        ->timezone('Asia/Jakarta')
                        ->default(now())
                        ->required(),
                    DateTimePicker::make('updated_at')
                        ->label('Tanggal Diperbarui')
                        ->disabled()
                        ->hiddenOn('create')
                        ->timezone('Asia/Jakarta')
                        ->default(now())
                        ->required(),
                    Fieldset::make('status')
                        ->schema([
                            Select::make('status')
                                ->label('Status')
                                ->options([
                                    'draft' => 'Draft',
                                    'published' => 'Published',
                                ])
                                ->default('draft')
                                ->required(),
                            DateTimePicker::make('published_at')
                                ->required()
                                ->timezone('Asia/Jakarta'),

                        ])->columnSpan(1),
                    FileUpload::make('thumbnail')
                        ->label('Thumbnail')
                        ->image()
                        ->disk('public')
                        ->directory('articles')
                        ->preserveFilenames()
                        ->required(),
                ])->columnSpan(1),

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->disk('public')
                    ->width(100),

                Tables\Columns\TextColumn::make('user.nama')
                    ->label('Nama Penulis')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Artikel')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.nama')
                    ->label('Nama Kategori'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Tanggal Publish')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistsSection::make([
                    ImageEntry::make('thumbnail')
                        ->size(200)
                        ->hiddenLabel(),
                    TextEntry::make('title')
                        ->size('lg')
                        ->hiddenLabel()
                        ->weight('bold'),
                    TextEntry::make('user.nama')
                        ->hiddenLabel(),
                    TextEntry::make('content')
                        ->html()
                        ->alignJustify()
                        ->hiddenLabel(),

                ])->columnSpan(2),
                InfolistsSection::make([
                    TextEntry::make('category.nama')
                        ->hiddenLabel(),
                    TextEntry::make('created_at')
                        ->default(now())
                        ->label('Tanggal Dibuat'),
                    TextEntry::make('updated_at')
                        ->default(now())
                        ->label('Tanggal Diperbarui'),
                    TextEntry::make('status')
                        ->label('Status'),
                    TextEntry::make('published_at')
                        ->default(now())
                        ->label('Tanggal Publikasi'),
                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function getRelations(): array
    {
        return [
            
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            // 'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }


    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with([
            'user' => fn($query) => $query->where('role', 'author'),
        ]);
    }
}
