<?php

namespace App\Filament\Support;

use App\Filament\Resources\Agents\AgentResource;
use App\Filament\Resources\Payments\PaymentResource;
use App\Filament\Resources\Properties\PropertyResource;
use App\Filament\Resources\PropertyInquiries\PropertyInquiryResource;

final class DashboardUrls
{
    public static function propertiesIndex(): string
    {
        return PropertyResource::getUrl('index');
    }

    public static function propertiesPending(): string
    {
        return PropertyResource::getUrl('index').'?'.http_build_query([
            'filters' => [
                'status' => [
                    'values' => ['pending'],
                ],
            ],
        ]);
    }

    public static function propertiesApproved(): string
    {
        return PropertyResource::getUrl('index').'?'.http_build_query([
            'filters' => [
                'status' => [
                    'values' => ['approved'],
                ],
            ],
        ]);
    }

    public static function agentsIndex(): string
    {
        return AgentResource::getUrl('index');
    }

    public static function paymentsIndex(): string
    {
        return PaymentResource::getUrl('index');
    }

    /**
     * Closest admin view for “people” (no User resource): property inquiries.
     */
    public static function inquiriesIndex(): string
    {
        return PropertyInquiryResource::getUrl('index');
    }

    public static function overviewFragment(): string
    {
        return self::dashboardUrl().'#dashboard-overview';
    }

    public static function dashboardUrl(): string
    {
        return \App\Filament\Pages\Dashboard::getUrl();
    }
}
