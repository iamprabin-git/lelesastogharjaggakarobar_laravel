<?php

namespace App\Filament\Agent\Resources\Properties\Pages;

use App\Filament\Agent\Resources\Properties\PropertyResource;
use App\Filament\Concerns\SyncsPropertyAmenityPivot;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateProperty extends CreateRecord
{
    use SyncsPropertyAmenityPivot;

    protected static string $resource = PropertyResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['agent_id'] = Auth::guard('agent')->id();

        return $data;
    }

    protected function afterCreate(): void
    {
        $this->syncPropertyAmenityPivot($this->getRecord());
    }
}
