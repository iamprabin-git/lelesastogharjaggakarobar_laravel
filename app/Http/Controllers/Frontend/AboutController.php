<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Inertia\Inertia;

class AboutController extends Controller
{
    public function index()
    {
        $about = AboutSection::first();

        return Inertia::render('About', [
            'about' => $about
                ? [
                    'hero_title' => $about->hero_title,
                    'hero_description' => $about->hero_description ? strip_tags($about->hero_description) : null,
                    'hero_image' => $about->hero_image ? asset('storage/'.$about->hero_image) : null,
                    'about_image' => $about->about_image ? asset('storage/'.$about->about_image) : null,
                    'experience_years' => $about->experience_years,
                    'properties_sold' => $about->properties_sold,
                    'happy_clients' => $about->happy_clients,
                    'mission' => $about->mission,
                    'vision' => $about->vision,
                ]
                : null,
        ]);
    }
}
