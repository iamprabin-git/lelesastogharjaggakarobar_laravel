<?php

namespace App\Filament\Widgets;

use App\Models\PropertyInquiry;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CrmStatsOverview extends BaseWidget
{
    protected static bool $isDiscovered = false;

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $base = PropertyInquiry::query();

        return [
            Stat::make('Total leads', (clone $base)->count())
                ->description('All property inquiries')
                ->descriptionIcon('heroicon-m-inbox')
                ->color('gray'),
            Stat::make('Unread', (clone $base)->where('is_read', false)->count())
                ->description('Needs attention')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('warning'),
            Stat::make('New', (clone $base)->where('crm_status', 'new')->count())
                ->color('info'),
            Stat::make('Contacted', (clone $base)->where('crm_status', 'contacted')->count())
                ->color('primary'),
            Stat::make('Qualified', (clone $base)->where('crm_status', 'qualified')->count())
                ->color('success'),
            Stat::make('Closed (won)', (clone $base)->where('crm_status', 'closed_won')->count())
                ->description('Deals won')
                ->color('success'),
            Stat::make('Closed (lost)', (clone $base)->where('crm_status', 'closed_lost')->count())
                ->description('Lost / not proceeding')
                ->color('danger'),
        ];
    }
}
