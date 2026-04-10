<?php

namespace App\Filament\Resources\PropertyInquiries\Pages;

use App\Filament\Pages\CrmConsole;
use App\Filament\Resources\PropertyInquiries\PropertyInquiryResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;

class ListPropertyInquiries extends ListRecords
{
    protected static string $resource = PropertyInquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('addLead')
                ->label('Add lead')
                ->icon(Heroicon::OutlinedPlus)
                ->url(static::getResource()::getUrl('create'))
                ->color('success'),
            Action::make('fullCrm')
                ->label('Open full CRM')
                ->icon(Heroicon::OutlinedChartBar)
                ->url(CrmConsole::getUrl())
                ->color('primary'),
        ];
    }
}
