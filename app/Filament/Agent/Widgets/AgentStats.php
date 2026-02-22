<?php

namespace App\Filament\Agent\Widgets;

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

            Stat::make('Unread Inquiries', $unreadInquiries)
                ->description('New messages from buyers')
                ->icon('heroicon-o-chat-bubble-left-ellipsis')
                ->color('danger'),
        ];
    }
}
