<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Property;

class ActivePropertiesWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Active Properties', Property::where('status', 'active')->count())
                ->description('Currently visible listings')
                ->descriptionIcon('heroicon-m-home-modern')
                ->color('success'),
        ];
    }
}
