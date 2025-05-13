<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Builder;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Enums\FontWeight;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(),
                Forms\Components\Select::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'author' => 'Author',
                        'user' => 'User',
                    ])
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->weight(FontWeight::Bold)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\Layout\Panel::make([
                    Tables\Columns\Layout\Split::make([
                        // Tables\Columns\ImageColumn::make('avatar')
                        //     ->circular(),
                        Tables\Columns\Layout\Stack::make([
                            Tables\Columns\TextColumn::make('email')
                                ->sortable()
                                ->icon('heroicon-m-envelope')
                                ->searchable(),
                            Tables\Columns\TextColumn::make('role')
                                ->sortable()
                                ->searchable(),
                        ]),
                        Tables\Columns\TextColumn::make('created_at')
                            ->dateTime()
                            ->searchable(),
                    ])->from('md'),
                ])->collapsed(false)


            ])
             ->contentGrid([
            'md' => 2,
            'xl' => 2,
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
            // 'create' => Pages\CreateUser::route('/create'),
            // 'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
