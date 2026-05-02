<?php

namespace App\Filament\Resources\AboutServices\Pages;

use App\Filament\Resources\AboutServices\AboutServiceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAboutServices extends ListRecords
{
    protected static string $resource = AboutServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
