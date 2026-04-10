<?php

namespace App\Filament\Agent\Widgets;

use App\Crm\CrmLeadStage;
use App\Models\PropertyInquiry;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class AgentCrmStatsOverview extends BaseWidget
{
    protected static bool $isDiscovered = false;

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $agentId = Auth::guard('agent')->id();

        $base = PropertyInquiry::query()->where('agent_id', $agentId);

        $open = (clone $base)->whereNotIn('crm_status', [
            CrmLeadStage::CLOSED_WON,
            CrmLeadStage::CLOSED_LOST,
        ])->count();

        $pipelineValue = (clone $base)
            ->whereNotIn('crm_status', [CrmLeadStage::CLOSED_WON, CrmLeadStage::CLOSED_LOST])
            ->sum('deal_value');

        $dueFollowUp = (clone $base)
            ->whereNotNull('next_follow_up_at')
            ->where('next_follow_up_at', '<=', now()->addDay())
            ->whereNotIn('crm_status', [CrmLeadStage::CLOSED_WON, CrmLeadStage::CLOSED_LOST])
            ->count();

        return [
            Stat::make('Active leads', number_format($open))
                ->description('Open pipeline')
                ->descriptionIcon('heroicon-m-funnel')
                ->color('primary'),
            Stat::make('Your pipeline (est.)', 'Rs. '.number_format((float) $pipelineValue))
                ->description('Sum of open deal values')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Follow-ups due (48h)', number_format($dueFollowUp))
                ->description('Scheduled touchpoints')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
            Stat::make('Won deals', (clone $base)->where('crm_status', CrmLeadStage::CLOSED_WON)->count())
                ->description('Closed — won')
                ->color('success'),
            Stat::make('Unread inquiries', (clone $base)->where('is_read', false)->count())
                ->description('Needs response')
                ->color('danger'),
        ];
    }
}
