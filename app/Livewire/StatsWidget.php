<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Keseluruhan Artikel', Article::count())
                ->description('Total Artikel')
                ->icon('heroicon-o-rectangle-stack')
                ->color('success'),

            Stat::make('Total Keseluruhan Project', Project::count())
                ->description('Total Project')
                ->icon('heroicon-o-rectangle-stack')
                ->color('success'),
        ];
    }
}
