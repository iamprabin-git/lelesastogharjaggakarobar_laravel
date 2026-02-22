<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Property;

class PendingPropertiesWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pending Properties', Property::where('status', 'pending')->count())
                ->description('Waiting for approval')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
        ];
    }
}
