<?php

namespace Database\Seeders;

use App\Models\MonthlySpotlight;
use Illuminate\Database\Seeder;

class MonthlySpotlightSeeder extends Seeder
{
    public function run(): void
    {
        MonthlySpotlight::query()->firstOrCreate(
            ['kind' => MonthlySpotlight::KIND_AGENT_OF_MONTH],
            [
                'honoree_name' => 'Featured agent',
                'subtitle' => 'Outstanding performance and client care',
                'period_label' => null,
                'page_title' => null,
                'image' => null,
                'congratulations_html' => '<p>Update this spotlight in Admin → Website → Monthly spotlights.</p>',
                'is_published' => false,
            ],
        );

        MonthlySpotlight::query()->firstOrCreate(
            ['kind' => MonthlySpotlight::KIND_BUYER_OF_MONTH],
            [
                'honoree_name' => 'Valued buyer',
                'subtitle' => 'Thank you for trusting us with your journey',
                'period_label' => null,
                'page_title' => null,
                'image' => null,
                'congratulations_html' => '<p>Update this spotlight in Admin → Website → Monthly spotlights.</p>',
                'is_published' => false,
            ],
        );
    }
}
