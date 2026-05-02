<?php

namespace App\Filament\Resources\MonthlySpotlights\Pages;

use App\Filament\Resources\MonthlySpotlights\MonthlySpotlightResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMonthlySpotlights extends ListRecords
{
    protected static string $resource = MonthlySpotlightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
