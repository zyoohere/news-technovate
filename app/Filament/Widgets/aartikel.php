<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\User;
use App\Models\Comment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\TableWidget;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Support\Facades\App;

class aartikel extends BaseWidget
{
    // Mendefinisikan statistik yang akan ditampilkan di widget
    protected function getStats(): array
    {
        return [
            Stat::make('Total Penulis', User::where('role', 'author')->count())
                ->color('success')
                ->icon('heroicon-o-user'),
            Stat::make('Total User', User::where('role', 'user')->count())
                ->icon('heroicon-o-user')
                ->color('success'),
            Stat::make('Total Artikel', Article::count())
                ->icon('heroicon-o-document-text')
                ->color('primary'),
            Stat::make('Total Komentar', Comment::count())
                ->icon('heroicon-o-chat-bubble-left')
                ->color('warning'),
        ];
    }


}
