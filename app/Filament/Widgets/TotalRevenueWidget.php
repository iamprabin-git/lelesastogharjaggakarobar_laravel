<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Payment;

class TotalRevenueWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $total = Payment::where('status', 'approved')->sum('amount') ?? 0;

        return [
            Stat::make('Total Revenue', 'Rs. ' . number_format($total, 0))
                ->description('From approved payments')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),
        ];
    }
}
