<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    /**
     * Seed common amenity types for property listings.
     */
    public function run(): void
    {
        $names = [
            'School',
            'Hospital',
            'Shopping mall',
            'Public park',
            'Bus stop',
            'Bank / ATM',
            'Restaurant',
            'Gym / fitness',
        ];

        foreach ($names as $name) {
            Amenity::query()->firstOrCreate(['name' => $name]);
        }
    }
}
