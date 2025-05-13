<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\TextColumn;
// Removed unused import
use Filament\Tables\Actions\Action;
use Filament\Forms\Form;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CommentResource\Pages\ListComments;
use App\Models\Article;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Enums\ActionSize;


/**
 * @param Builder $query
 * @param mixed $value
 * @return Builder
 */

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left';
    protected static ?string $navigationGroup = 'Manajament Interaksi';

    public static function form(Form $form): Form
    {
        return $form
         ->schema([]);
    }
    public static function table(Table $table): Table
    {
        return $table
        ->defaultGroup('status')
            ->columns([
                Tables\Columns\TextColumn::make('user.nama')->label('Nama'),
                Tables\Columns\TextColumn::make('article.title')->label('Artikel'),
                Tables\Columns\TextColumn::make('content')->label('Komentar')->limit(50),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal')
                    ->sortable()
                    ->dateTime('d M Y - H:i'),
                Tables\Columns\TextColumn::make('status')->badge()->color(fn($state) => match ($state) {
                    'approved' => 'success',
                    'pending' => 'warning',
                    'rejected' => 'danger',
                }),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'approved' => 'Disetujui',
                        'pending' => 'Belum Disetujui',
                        'rejected' => 'Spam / Dihapus',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                 ->form([
                    TextInput::make('user.nama'),
                    TextInput::make('article.title'),
                    TextInput::make('content'),
                    // ...
                ]),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\DeleteAction::make()
                        ->action(fn(Comment $record) => $record->delete())
                        ->requiresConfirmation()
                        ->modalHeading('Delete post')
                        ->modalDescription('Are you sure you\'d like to delete this post? This cannot be undone.')
                        ->modalSubmitActionLabel('Yes, delete it'),
                    Tables\Actions\Action::make('Setuju')
                        ->color('green')
                        ->icon('heroicon-m-pencil-square')
                        ->visible(fn($record) => $record->status === 'pending')
                        ->action(fn($record) => $record->update(['status' => 'approved'])),
                    Tables\Actions\Action::make('Spam')
                        ->color('danger')
                        ->icon('heroicon-o-exclamation-circle')
                        ->visible(fn($record) => $record->status !== 'rejected')
                        ->action(fn($record) => $record->update(['status' => 'rejected'])),
                 

                ])
                    ->label('More actions')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->color('primary')
                    ->button()

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
            'index' => Pages\ListComments::route('/'),
            // 'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
