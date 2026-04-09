<?php

namespace App\Filament\Resources\Properties\Pages;

use App\Filament\Concerns\SyncsPropertyAmenityPivot;
use App\Filament\Resources\Properties\PropertyResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProperty extends CreateRecord
{
    use SyncsPropertyAmenityPivot;

    protected static string $resource = PropertyResource::class;

    protected function afterCreate(): void
    {
        $this->syncPropertyAmenityPivot($this->getRecord());
    }
}
