<?php

namespace App\Filament\Concerns;

use App\Filament\Support\PropertyAmenityRepeater;
use App\Models\Property;

trait SyncsPropertyAmenityPivot
{
    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mergeAmenityRowsIntoFormData(array $data): array
    {
        $record = $this->getRecord();

        if ($record instanceof Property && $record->exists) {
            $record->loadMissing('amenities');
            $data[PropertyAmenityRepeater::FIELD] = $record->amenities
                ->map(fn ($a) => [
                    'amenity_id' => (string) $a->id,
                    'distance' => $a->pivot->distance !== null ? (string) $a->pivot->distance : null,
                    'unit' => $a->pivot->unit ?? 'km',
                ])
                ->values()
                ->all();
        }

        return $data;
    }

    protected function syncPropertyAmenityPivot(mixed $property): void
    {
        if (! $property instanceof Property) {
            return;
        }

        /** @var array<int, array{amenity_id?: int|string|null, distance?: float|int|string|null, unit?: string|null}> $rows */
        $rows = data_get($this->data, PropertyAmenityRepeater::FIELD, []);

        if (! is_array($rows)) {
            $rows = [];
        }

        $sync = [];

        foreach ($rows as $row) {
            if (empty($row['amenity_id'])) {
                continue;
            }

            $id = (int) $row['amenity_id'];
            $unit = ($row['unit'] ?? 'km') === 'm' ? 'm' : 'km';

            $distance = null;
            if (isset($row['distance']) && $row['distance'] !== '' && $row['distance'] !== null) {
                $distance = (float) $row['distance'];
            }

            $sync[$id] = [
                'distance' => $distance,
                'unit' => $unit,
            ];
        }

        $property->amenities()->sync($sync);
    }
}
