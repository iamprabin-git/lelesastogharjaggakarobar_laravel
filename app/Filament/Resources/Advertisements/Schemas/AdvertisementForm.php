<?php

namespace App\Filament\Resources\Advertisements\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AdvertisementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                ->required()
                ->maxLength(255),

            TextInput::make('link')
                ->url()
                ->maxLength(255),

            FileUpload::make('image')
                ->image()
                ->directory('advertisements')
                ->required(),

            DatePicker::make('expiry_date')
                ->label('Expiry Date')
                ->minDate(now()),

            Toggle::make('is_active')
                ->label('Active')
                ->default(true),
            ]);
    }
}
