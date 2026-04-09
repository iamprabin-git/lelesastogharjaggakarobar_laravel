<?php

namespace App\Filament\Agent\Resources\Properties\Pages;

use App\Filament\Agent\Resources\Properties\PropertyResource;
use App\Filament\Concerns\SyncsPropertyAmenityPivot;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProperty extends EditRecord
{
    use SyncsPropertyAmenityPivot;

    protected static string $resource = PropertyResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        return $this->mergeAmenityRowsIntoFormData(parent::mutateFormDataBeforeFill($data));
    }

    protected function afterSave(): void
    {
        $this->syncPropertyAmenityPivot($this->getRecord());
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
