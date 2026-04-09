<?php

namespace App\Filament\Agent\Resources\Properties\Schemas;

use App\Filament\Support\PropertyAmenityRepeater;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                RichEditor::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('RS'),
                Select::make('type')
                    ->options(['sale' => 'Sale', 'rent' => 'Rent'])
                    ->default('sale')
                    ->required(),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'])
                    ->default('pending')
                    ->required(),
                Select::make('availability')
                    ->options(['available' => 'Available', 'rented' => 'Rented', 'sold' => 'Sold'])
                    ->default('available')
                    ->required(),
                TextInput::make('bedrooms')
                    ->numeric()
                    ->default(null),
                TextInput::make('bathrooms')
                    ->numeric()
                    ->default(null),
                TextInput::make('area')
                    ->numeric()
                    ->default(null),
                TextInput::make('location')
                    ->default(null),
                TextInput::make('city')
                    ->default(null),
                TextInput::make('state')
                    ->default(null),
                TextInput::make('country')
                    ->default(null),
                FileUpload::make('images')
                    ->required()
                    ->multiple(),

                TextInput::make('youtube_link')
                    ->default(null),
                TextInput::make('latitude')
                    ->numeric()
                    ->default(null),
                TextInput::make('longitude')
                    ->numeric()
                    ->default(null),
                PropertyAmenityRepeater::make(),
            ]);
    }
}
