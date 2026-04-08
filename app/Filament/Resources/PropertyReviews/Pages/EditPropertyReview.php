<?php

namespace App\Filament\Resources\PropertyReviews\Pages;

use App\Filament\Resources\PropertyReviews\PropertyReviewResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPropertyReview extends EditRecord
{
    protected static string $resource = PropertyReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
