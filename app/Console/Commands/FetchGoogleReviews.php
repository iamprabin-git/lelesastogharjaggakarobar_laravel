<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\GoogleReview;

class FetchGoogleReviews extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'fetch:google-reviews';

    /**
     * The console command description.
     */
    protected $description = 'Fetch Google reviews and store in database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get(
            'https://maps.googleapis.com/maps/api/place/details/json',
            [
                'place_id' => env('GOOGLE_PLACE_ID'),
                'fields'   => 'rating,reviews',
                'key'      => config('services.google_maps.key'),
            ]
        );

        if (!$response->successful()) {
            $this->error('Failed to connect to Google API.');
            return;
        }

        $data = $response->json();

        if (!isset($data['result']['reviews'])) {
            $this->error('No reviews found.');
            return;
        }

        // Clear old reviews
        GoogleReview::truncate();

        foreach ($data['result']['reviews'] as $review) {
            GoogleReview::create([
                'author_name'   => $review['author_name'],
                'profile_photo' => $review['profile_photo_url'] ?? null,
                'rating'        => $review['rating'],
                'text'          => $review['text'],
                'review_time'   => now(),
            ]);
        }

        $this->info('Google reviews updated successfully.');
    }
}
