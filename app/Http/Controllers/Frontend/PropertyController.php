<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Property;
use App\Models\PropertyReview;
use App\Models\UserPropertySearch;
use App\Support\InertiaSerializers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PropertyController extends Controller
{
    // Properties Listing Page (ONLY APPROVED)
    public function index(Request $request)
    {
        $query = Property::approved()->available();

        $filteredAgent = null;
        if ($request->filled('agent')) {
            $agentId = (int) $request->input('agent');
            if ($agentId > 0) {
                $agent = Agent::query()->publicDirectory()->whereKey($agentId)->first();
                if ($agent !== null) {
                    $query->where('agent_id', $agent->id);
                    $filteredAgent = [
                        'id' => $agent->id,
                        'name' => $agent->name,
                    ];
                }
            }
        }

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->keyword.'%')
                    ->orWhere('location', 'like', '%'.$request->keyword.'%')
                    ->orWhere('city', 'like', '%'.$request->keyword.'%');
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

        $latestProperties = $query->with('agent')->paginate(9)->withQueryString();
        $latestProperties->getCollection()->transform(function (Property $p) {
            return InertiaSerializers::propertyCard($p);
        });

        if ($request->user()) {
            $filterKeys = ['keyword', 'city', 'type', 'bedrooms', 'min_price', 'max_price', 'sort'];
            $hasFilter = false;
            foreach ($filterKeys as $key) {
                if (filled($request->input($key))) {
                    $hasFilter = true;
                    break;
                }
            }
            if ($hasFilter) {
                UserPropertySearch::query()->create([
                    'user_id' => $request->user()->id,
                    'keyword' => $request->input('keyword') ?: null,
                    'city' => $request->input('city') ?: null,
                    'type' => $request->input('type') ?: null,
                    'bedrooms' => $request->input('bedrooms') ?: null,
                    'min_price' => $request->input('min_price') ?: null,
                    'max_price' => $request->input('max_price') ?: null,
                    'sort' => $request->input('sort') ?: null,
                ]);
                UserPropertySearch::pruneForUser($request->user()->id);
            }
        }

        return Inertia::render('Properties/Index', [
            'latestProperties' => $latestProperties,
            'filtered_agent' => $filteredAgent,
            'filters' => [
                'keyword' => $request->input('keyword', ''),
                'city' => $request->input('city', ''),
                'type' => $request->input('type', ''),
                'bedrooms' => $request->input('bedrooms', ''),
                'min_price' => $request->input('min_price', ''),
                'max_price' => $request->input('max_price', ''),
                'sort' => $request->input('sort', ''),
                'agent' => $filteredAgent !== null ? (string) $filteredAgent['id'] : '',
            ],
        ]);
    }

    /**
     * Approved properties marked as sold (archive list — no detail page for these listings).
     */
    public function sold()
    {
        $properties = Property::query()
            ->approved()
            ->sold()
            ->with('agent')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $properties->getCollection()->transform(function (Property $p) {
            return InertiaSerializers::propertyCard($p);
        });

        return Inertia::render('SoldProperties', [
            'properties' => $properties,
        ]);
    }

    public function show(Property $property)
    {
        if ($property->status !== 'approved' ||
            $property->availability !== 'available') {
            abort(404);
        }

        $property->load(['agent', 'amenities']);

        $approvedReviews = $property->approvedReviews()->with('user')->latest()->get();
        $reviewAverage = $approvedReviews->avg('rating') ?? 0;
        $reviewCount = $approvedReviews->count();

        $relatedProperties = Property::approved()
            ->available()
            ->with('agent')
            ->where('city', $property->city)
            ->where('id', '!=', $property->id)
            ->latest()
            ->limit(6)
            ->get();

        $userReview = auth()->check()
            ? PropertyReview::where('property_id', $property->id)->where('user_id', auth()->id())->first()
            : null;

        return Inertia::render('Properties/Show', [
            'property' => InertiaSerializers::propertyDetail($property),
            'relatedProperties' => $relatedProperties
                ->map(fn (Property $p) => InertiaSerializers::propertyCard($p->loadMissing('agent')))
                ->values()
                ->all(),
            'approvedReviews' => $approvedReviews
                ->map(fn (PropertyReview $r) => [
                    'id' => $r->id,
                    'rating' => $r->rating,
                    'comment' => $r->comment,
                    'created_at' => $r->created_at->toIso8601String(),
                    'user_name' => $r->user->name ?? 'User',
                ])
                ->values()
                ->all(),
            'reviewAverage' => round((float) $reviewAverage, 1),
            'reviewCount' => $reviewCount,
            'userReview' => $userReview ? ['status' => $userReview->status] : null,
        ]);
    }

    public function storeReview(Request $request, Property $property)
    {
        if ($property->status !== 'approved' || $property->availability !== 'available') {
            abort(404);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:2000',
        ]);

        $exists = PropertyReview::where('property_id', $property->id)
            ->where('user_id', $request->user()->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'You have already submitted a review for this property.');
        }

        PropertyReview::create([
            'property_id' => $property->id,
            'user_id' => $request->user()->id,
            'rating' => (int) $request->rating,
            'comment' => $request->comment,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Thank you. Your review will be published after an administrator approves it.');
    }

    public function edit(Property $property)
    {
        return Inertia::render('Properties/Edit', [
            'property' => InertiaSerializers::propertyForEdit($property),
        ]);
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
