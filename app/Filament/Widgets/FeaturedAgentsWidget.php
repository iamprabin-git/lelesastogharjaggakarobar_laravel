<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;

class FeaturedAgentsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Featured Agents', User::where('role', 'agent')->count())
                ->description('Top verified agents')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),
        ];
    }
}
