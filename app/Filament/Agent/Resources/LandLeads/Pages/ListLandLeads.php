<?php

namespace App\Filament\Agent\Resources\LandLeads\Pages;

use App\Filament\Agent\Resources\LandLeads\LandLeadResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;

class ListLandLeads extends ListRecords
{
    protected static string $resource = LandLeadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('addLead')
                ->label('Add lead')
                ->icon(Heroicon::OutlinedPlus)
                ->url(static::getResource()::getUrl('create'))
                ->color('success'),
        ];
    }
}
