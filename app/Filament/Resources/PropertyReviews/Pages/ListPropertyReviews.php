<?php

namespace App\Filament\Resources\PropertyReviews\Pages;

use App\Filament\Resources\PropertyReviews\PropertyReviewResource;
use Filament\Resources\Pages\ListRecords;

class ListPropertyReviews extends ListRecords
{
    protected static string $resource = PropertyReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
