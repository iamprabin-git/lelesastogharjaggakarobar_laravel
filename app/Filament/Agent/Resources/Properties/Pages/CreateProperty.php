<?php

namespace App\Filament\Agent\Resources\Properties\Pages;

use App\Filament\Agent\Resources\Properties\PropertyResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateProperty extends CreateRecord
{
    protected static string $resource = PropertyResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['agent_id'] = Auth::user()->id;
        return $data;
    }
}
