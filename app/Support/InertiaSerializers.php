<?php

namespace App\Support;

use App\Models\Advertisement;
use App\Models\GoogleReview;
use App\Models\Property;
use Illuminate\Support\Collection;

class InertiaSerializers
{
    public static function propertyCard(Property $p): array
    {
        $images = $p->images;
        $first = is_array($images) && count($images) > 0 ? asset('storage/'.$images[0]) : null;

        return [
            'id' => $p->id,
            'title' => $p->title,
            'slug' => $p->getKey(),
            'price' => (float) $p->price,
            'type' => $p->type,
            'availability' => $p->availability,
            'location' => $p->location,
            'city' => $p->city,
            'bedrooms' => $p->bedrooms,
            'bathrooms' => $p->bathrooms,
            'area' => $p->area,
            'is_featured' => (bool) ($p->is_featured ?? false),
            'image' => $first,
            'agent' => $p->relationLoaded('agent') && $p->agent ? ['name' => $p->agent->name] : null,
        ];
    }

    public static function propertyDetail(Property $p): array
    {
        $images = [];
        if (is_array($p->images)) {
            foreach ($p->images as $img) {
                $images[] = asset('storage/'.$img);
            }
        }

        $amenities = $p->relationLoaded('amenities')
            ? $p->amenities->map(fn ($a) => [
                'id' => $a->id,
                'name' => $a->name,
                'distance' => $a->pivot->distance ?? null,
                'unit' => $a->pivot->unit ?? null,
            ])->values()->all()
            : [];

        return [
            'id' => $p->id,
            'title' => $p->title,
            'description' => $p->description,
            'price' => (float) $p->price,
            'type' => $p->type,
            'availability' => $p->availability,
            'location' => $p->location,
            'city' => $p->city,
            'state' => $p->state,
            'country' => $p->country,
            'bedrooms' => $p->bedrooms,
            'bathrooms' => $p->bathrooms,
            'area' => $p->area,
            'images' => $images,
            'youtube_link' => $p->youtube_link,
            'youtube_embed' => Property::youtubeEmbedUrl($p->youtube_link),
            'latitude' => $p->latitude,
            'longitude' => $p->longitude,
            'amenities' => $amenities,
            'agent' => $p->relationLoaded('agent') && $p->agent
                ? [
                    'id' => $p->agent->id,
                    'name' => $p->agent->name,
                    'email' => $p->agent->email,
                    'phone' => $p->agent->phone,
                    'avatar' => $p->agent->avatar ? asset('storage/'.$p->agent->avatar) : null,
                    'facebook' => $p->agent->facebook,
                    'twitter' => $p->agent->twitter,
                    'linkedin' => $p->agent->linkedin,
                    'instagram' => $p->agent->instagram,
                ]
                : null,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function propertyForEdit(Property $p): array
    {
        $images = [];
        if (is_array($p->images)) {
            foreach ($p->images as $index => $path) {
                $images[] = [
                    'index' => $index,
                    'url' => asset('storage/'.$path),
                ];
            }
        }

        return [
            'id' => $p->id,
            'title' => $p->title,
            'description' => $p->description ?? '',
            'price' => (float) $p->price,
            'type' => $p->type,
            'availability' => $p->availability,
            'status' => $p->status,
            'youtube_link' => $p->youtube_link ?? '',
            'images' => $images,
        ];
    }

    /**
     * @param  Collection<int, GoogleReview>  $reviews
     * @return list<array<string, mixed>>
     */
    public static function googleReviews(Collection $reviews): array
    {
        return $reviews->map(fn (GoogleReview $r) => [
            'id' => $r->id,
            'author_name' => $r->author_name,
            'profile_photo' => $r->profile_photo,
            'rating' => $r->rating,
            'text' => $r->text,
        ])->values()->all();
    }

    /**
     * @param  Collection<int, Advertisement>  $ads
     * @return list<array<string, mixed>>
     */
    public static function advertisements(Collection $ads): array
    {
        return $ads->map(fn (Advertisement $a) => [
            'id' => $a->id,
            'title' => $a->title ?? null,
            'link' => $a->link,
            'image' => $a->image ? asset('storage/'.$a->image) : null,
        ])->values()->all();
    }
}
