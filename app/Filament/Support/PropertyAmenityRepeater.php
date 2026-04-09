<?php

namespace App\Filament\Support;

use App\Models\Amenity;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class PropertyAmenityRepeater
{
    public const FIELD = 'amenity_rows';

    public static function make(): Repeater
    {
        return Repeater::make(self::FIELD)
            ->label('Nearby amenities')
            ->helperText('Choose amenities from the catalog and optional distance. Manage the list under Amenities in the admin panel.')
            ->schema([
                Select::make('amenity_id')
                    ->label('Amenity')
                    ->options(fn () => Amenity::query()->orderBy('name')->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->disableOptionsWhenSelectedInSiblingRepeaterItems(),
                TextInput::make('distance')
                    ->label('Distance')
                    ->numeric()
                    ->nullable(),
                Select::make('unit')
                    ->label('Unit')
                    ->options([
                        'km' => 'Kilometers',
                        'm' => 'Meters',
                    ])
                    ->default('km')
                    ->required(),
            ])
            ->columns(2)
            ->addActionLabel('Add amenity')
            ->defaultItems(0)
            ->collapsible()
            ->itemLabel(function (array $state): ?string {
                if (empty($state['amenity_id'])) {
                    return __('New amenity');
                }

                return Amenity::query()->whereKey($state['amenity_id'])->value('name') ?? __('Amenity');
            })
            ->columnSpanFull();
    }
}
