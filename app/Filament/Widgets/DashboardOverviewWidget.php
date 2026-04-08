<?php

namespace App\Filament\Widgets;

use App\Filament\Support\DashboardUrls;
use App\Models\Agent;
use App\Models\Payment;
use App\Models\Property;
use App\Models\User;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Section;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardOverviewWidget extends StatsOverviewWidget
{
    protected static ?int $sort = -2;

    protected ?string $heading = 'Overview';

    protected ?string $description = 'Live snapshot of listings, people, and revenue.';

    /**
     * @var int | array<string, ?int> | null
     */
    protected int|array|null $columns = [
        'default' => 1,
        'sm' => 2,
        'md' => 3,
        'lg' => 4,
        'xl' => 5,
    ];

    public function getSectionContentComponent(): Component
    {
        return Section::make()
            ->id('dashboard-overview')
            ->heading($this->getHeading())
            ->description($this->getDescription())
            ->schema($this->getCachedStats())
            ->columns($this->getColumns())
            ->contained(false)
            ->gridContainer();
    }

    protected function getStats(): array
    {
        $revenue = Payment::where('status', 'approved')->sum('amount') ?? 0;

        return [
            Stat::make('Live listings', Property::approved()->available()->count())
                ->description('Approved & available')
                ->descriptionIcon('heroicon-m-home-modern')
                ->color('success')
                ->url(DashboardUrls::propertiesApproved()),
            Stat::make('Pending review', Property::where('status', 'pending')->count())
                ->description('Awaiting approval')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning')
                ->url(DashboardUrls::propertiesPending()),
            Stat::make('Site users', User::count())
                ->description('Registered accounts')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->url(DashboardUrls::inquiriesIndex()),
            Stat::make('Agents', Agent::count())
                ->description('Agent accounts')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('gray')
                ->url(DashboardUrls::agentsIndex()),
            Stat::make('Revenue', 'Rs. '.number_format((float) $revenue, 0))
                ->description('Approved payments')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success')
                ->url(DashboardUrls::paymentsIndex()),
        ];
    }
}
