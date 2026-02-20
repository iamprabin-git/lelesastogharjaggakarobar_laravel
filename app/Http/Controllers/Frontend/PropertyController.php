<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    // Properties Listing Page (ONLY APPROVED)
    public function index(Request $request)
    {
        $query = Property::approved()->available();

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->keyword . '%')
                  ->orWhere('location', 'like', '%' . $request->keyword . '%')
                  ->orWhere('city', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('bedrooms')) {
            if ($request->bedrooms == 4) {
                $query->where('bedrooms', '>=', 4);
            } else {
                $query->where('bedrooms', $request->bedrooms);
            }
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('sort')) {
            if ($request->sort == 'low_high') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort == 'high_low') {
                $query->orderBy('price', 'desc');
            }
        } else {
            $query->latest();
        }

        $latestProperties = $query->paginate(9)->withQueryString();

        return view('frontend.properties.index', compact('latestProperties'));
    }

    public function show(Property $property)
    {
        if ($property->status !== 'approved' ||
            $property->availability !== 'available') {
            abort(404);
        }

        $property->load(['agent', 'amenities']);

        $relatedProperties = Property::approved()
            ->available()
            ->where('city', $property->city)
            ->where('id', '!=', $property->id)
            ->latest()
            ->limit(6)
            ->get();

        return view('frontend.properties.show', compact('property', 'relatedProperties'));
    }

    public function edit(Property $property)
    {
        $allAmenities = Amenity::all();
        return view('frontend.properties.edit', compact('property', 'allAmenities'));
    }

    public function update(Request $request, Property $property)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'type' => 'required|in:sale,rent',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'youtube_link' => 'nullable|url',
            'status' => 'required|in:pending,approved,rejected',
            'availability' => 'required|in:available,rented,sold',
        ]);

        $property->update($request->all());

        if ($request->hasFile('images')) {
            $images = $property->images ?? [];

            foreach ($request->file('images') as $file) {
                $images[] = $file->store('properties', 'public');
            }

            $property->images = $images;
            $property->save();
        }

        return redirect()
            ->route('properties.show', $property)
            ->with('success', 'Property updated successfully!');
    }

    public function deleteImage(Property $property, $index)
    {
        $images = $property->images;

        if (isset($images[$index])) {
            Storage::disk('public')->delete($images[$index]);
            unset($images[$index]);
            $property->images = array_values($images);
            $property->save();
        }

        return back()->with('success', 'Image deleted successfully.');
    }
}
