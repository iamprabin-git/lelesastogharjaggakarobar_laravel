<?php

namespace App\Filament\Agent\Widgets;

use App\Crm\CrmLeadStage;
use App\Models\Property;
use App\Models\PropertyInquiry;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class AgentStats extends BaseWidget
{
    protected function getStats(): array
    {
        $agentId = Auth::guard('agent')->id();

        $totalProperties = Property::where('agent_id', $agentId)->count();
        $approvedProperties = Property::where('agent_id', $agentId)->where('status', 'approved')->count();
        $pendingProperties = Property::where('agent_id', $agentId)->where('status', 'pending')->count();

        $unreadInquiries = PropertyInquiry::where('agent_id', $agentId)
            ->where('is_read', false)
            ->count();

        $activeLeads = PropertyInquiry::where('agent_id', $agentId)
            ->whereNotIn('crm_status', [CrmLeadStage::CLOSED_WON, CrmLeadStage::CLOSED_LOST])
            ->count();

        $wonDeals = PropertyInquiry::where('agent_id', $agentId)
            ->where('crm_status', CrmLeadStage::CLOSED_WON)
            ->count();

        return [
            Stat::make('Total Properties', $totalProperties)
                ->description('All your listed properties')
                ->icon('heroicon-o-home')
                ->color('primary'),

            Stat::make('Approved', $approvedProperties)
                ->description('Properties approved')
                ->icon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Pending', $pendingProperties)
                ->description('Awaiting approval')
                ->icon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('Active sales leads', $activeLeads)
                ->description('Open pipeline (not won/lost)')
                ->icon('heroicon-o-funnel')
                ->color('primary'),

            Stat::make('Unread inquiries', $unreadInquiries)
                ->description('Needs first response')
                ->icon('heroicon-o-chat-bubble-left-ellipsis')
                ->color('warning'),

            Stat::make('Deals won', $wonDeals)
                ->description('Closed — won')
                ->icon('heroicon-o-check-badge')
                ->color('success'),
        ];
    }
}
