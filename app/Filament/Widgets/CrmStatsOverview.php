<?php

namespace App\Filament\Widgets;

use App\Crm\CrmLeadStage;
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

        $open = (clone $base)->whereNotIn('crm_status', [
            CrmLeadStage::CLOSED_WON,
            CrmLeadStage::CLOSED_LOST,
        ])->count();

        $dueFollowUp = (clone $base)
            ->whereNotNull('next_follow_up_at')
            ->where('next_follow_up_at', '<=', now()->addDay())
            ->whereNotIn('crm_status', [CrmLeadStage::CLOSED_WON, CrmLeadStage::CLOSED_LOST])
            ->count();

        $pipelineValue = (clone $base)
            ->whereNotIn('crm_status', [CrmLeadStage::CLOSED_WON, CrmLeadStage::CLOSED_LOST])
            ->sum('deal_value');

        return [
            Stat::make('Active pipeline', number_format($open))
                ->description('Leads not closed won/lost')
                ->descriptionIcon('heroicon-m-funnel')
                ->color('primary'),
            Stat::make('Pipeline value (est.)', 'Rs. '.number_format((float) $pipelineValue))
                ->description('Sum of open deal estimates')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Follow-ups due (48h)', number_format($dueFollowUp))
                ->description('Scheduled follow-up soon')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
            Stat::make('Total leads', (clone $base)->count())
                ->description('All land / listing inquiries')
                ->descriptionIcon('heroicon-m-inbox')
                ->color('gray'),
            Stat::make('Unread', (clone $base)->where('is_read', false)->count())
                ->description('Needs first touch')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('warning'),
            Stat::make('Site visit', (clone $base)->where('crm_status', CrmLeadStage::SITE_VISIT)->count())
                ->description('Inspection / viewing stage')
                ->color('warning'),
            Stat::make('Pending close', (clone $base)->where('crm_status', CrmLeadStage::PENDING_CLOSE)->count())
                ->description('Settlement in progress')
                ->color('success'),
            Stat::make('Closed (won)', (clone $base)->where('crm_status', CrmLeadStage::CLOSED_WON)->count())
                ->description('Won deals')
                ->color('success'),
            Stat::make('Closed (lost)', (clone $base)->where('crm_status', CrmLeadStage::CLOSED_LOST)->count())
                ->description('Did not proceed')
                ->color('danger'),
        ];
    }
}
