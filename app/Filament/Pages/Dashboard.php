<?php

namespace App\Filament\Pages;

use App\Filament\Support\DashboardUrls;
use BackedEnum;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class Dashboard extends BaseDashboard
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartPie;

    protected static ?string $title = 'Dashboard';

    /**
     * @return int | array<string, int | null>
     */
    public function getColumns(): int|array
    {
        return 1;
    }

    public function getSubheading(): string|Htmlable|null
    {
        $lc = e(DashboardUrls::propertiesApproved());
        $ap = e(DashboardUrls::propertiesPending());
        $leads = e(DashboardUrls::inquiriesIndex());
        $contact = e(DashboardUrls::contactMessagesIndex());
        $ag = e(DashboardUrls::agentsIndex());
        $rv = e(DashboardUrls::paymentsIndex());
        $ov = e(DashboardUrls::overviewFragment());

        $a = 'font-medium text-primary-600 hover:text-primary-500 hover:underline dark:text-primary-400 dark:hover:text-primary-300';

        return new HtmlString(
            'Monitor '.
            "<a href=\"{$lc}\" class=\"{$a}\">listings</a>, ".
            "<a href=\"{$ap}\" class=\"{$a}\">approvals</a>, ".
            "<a href=\"{$leads}\" class=\"{$a}\">land leads</a>, ".
            "<a href=\"{$contact}\" class=\"{$a}\">contact form</a>, ".
            "<a href=\"{$ag}\" class=\"{$a}\">agents</a>, ".
            'and '.
            "<a href=\"{$rv}\" class=\"{$a}\">revenue</a> ".
            'in one place. Jump to the '.
            "<a href=\"{$ov}\" class=\"{$a}\">Overview</a> stats below."
        );
    }
}
