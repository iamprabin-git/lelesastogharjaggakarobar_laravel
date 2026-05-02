<?php

namespace App\Support;

use App\Models\AboutSection;

class AboutPageData
{
    /**
     * @return array<string, mixed>
     */
    public static function inertia(?AboutSection $section): array
    {
        $defaults = config('about.defaults');

        if ($section === null) {
            return [
                'hero_title' => $defaults['hero_title'],
                'hero_description' => $defaults['hero_description'],
                'hero_image' => self::publicAsset($defaults['hero_image'] ?? null),
                'about_image' => self::publicAsset($defaults['about_image'] ?? null),
                'experience_years' => $defaults['experience_years'],
                'properties_sold' => (int) $defaults['properties_sold'],
                'happy_clients' => (int) $defaults['happy_clients'],
                'mission' => $defaults['mission'],
                'vision' => $defaults['vision'],
            ];
        }

        return [
            'hero_title' => $section->hero_title,
            'hero_description' => $section->hero_description
                ? strip_tags($section->hero_description)
                : $defaults['hero_description'],
            'hero_image' => $section->hero_image
                ? asset('storage/'.$section->hero_image)
                : self::publicAsset($defaults['hero_image'] ?? null),
            'about_image' => $section->about_image
                ? asset('storage/'.$section->about_image)
                : self::publicAsset($defaults['about_image'] ?? null),
            'experience_years' => $section->experience_years,
            'properties_sold' => $section->properties_sold,
            'happy_clients' => $section->happy_clients,
            'mission' => $section->mission ?: $defaults['mission'],
            'vision' => $section->vision ?: $defaults['vision'],
        ];
    }

    private static function publicAsset(?string $path): ?string
    {
        if ($path === null || $path === '') {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return asset($path);
    }
}
