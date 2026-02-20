<?php

namespace App\Filament\Agent\Resources\Properties\Schemas;

use Dom\Text;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

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
                // Select::make('agent_id')
                //     ->relationship('agent', 'name')
                //     ->default(Auth::user()->id )
                //     ->disabled()
                //     ->required(),
                Repeater::make('Amenities')
                ->columnSpanFull()
                ->grid(2)
                ->schema([
                    TextInput::make('name')
                        ->required(),
                        TextInput::make('distance')
                        ->default(null),
                    Select::make('unit')
                        ->options(['km' => 'Kilometers', 'm' => 'Meters'])
                        ->default('km')
                        ->required(),

                ])
            ]);
    }
}
