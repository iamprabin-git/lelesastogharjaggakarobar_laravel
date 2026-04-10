<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Property;
use App\Support\InertiaSerializers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(Request $request): Response
    {
        $user = $request->user();
        $company = Company::query()->where('status', true)->first();

        $whatsappDigits = (string) config('support.whatsapp_digits', '');
        if ($whatsappDigits === '' && $company?->phone) {
            $whatsappDigits = preg_replace('/\D/', '', $company->phone) ?? '';
        }

        $supportEmail = $company?->email ?: 'info.lelesastogharjaggakarobar@gmail.com';
        $supportPhoneDisplay = $company?->phone;
        $messengerUrl = config('support.messenger_url');

        $recentSearches = $user
            ->propertySearches()
            ->latest()
            ->limit(8)
            ->get()
            ->map(fn ($s) => [
                'id' => $s->id,
                'label' => $s->summaryLabel(),
                'params' => $s->queryParams(),
            ])
            ->values()
            ->all();

        $spotlightProperties = Property::query()
            ->approved()
            ->available()
            ->with('agent')
            ->latest()
            ->limit(6)
            ->get()
            ->map(fn (Property $p) => InertiaSerializers::propertyCard($p))
            ->values()
            ->all();

        $reviewCount = $user->propertyReviews()->count();

        return Inertia::render('Account/Dashboard', [
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at?->toAtomString(),
                'initials' => self::initials($user->name),
            ],
            'stats' => [
                'reviews_written' => $reviewCount,
            ],
            'recentSearches' => $recentSearches,
            'spotlightProperties' => $spotlightProperties,
            'support' => [
                'whatsapp_digits' => $whatsappDigits,
                'messenger_url' => $messengerUrl,
                'email' => $supportEmail,
                'phone_display' => $supportPhoneDisplay,
                'company_name' => $company?->name,
            ],
        ]);
    }

    public function propertySuggestions(Request $request): JsonResponse
    {
        $q = trim((string) $request->query('q', ''));
        if (mb_strlen($q) < 2) {
            return response()->json([]);
        }

        $like = '%'.str_replace(['%', '_'], ['\\%', '\\_'], $q).'%';

        $rows = Property::query()
            ->approved()
            ->available()
            ->where(function ($query) use ($like) {
                $query->where('title', 'like', $like)
                    ->orWhere('city', 'like', $like)
                    ->orWhere('location', 'like', $like);
            })
            ->orderByDesc('id')
            ->limit(10)
            ->get(['id', 'title', 'city', 'location', 'price', 'type']);

        return response()->json(
            $rows->map(fn (Property $p) => [
                'id' => $p->id,
                'title' => $p->title,
                'city' => $p->city,
                'location' => $p->location,
                'price' => (float) $p->price,
                'type' => $p->type,
            ])->values()->all()
        );
    }

    private static function initials(string $name): string
    {
        $parts = preg_split('/\s+/', trim($name)) ?: [];
        $letters = '';
        foreach (array_slice($parts, 0, 2) as $part) {
            if ($part !== '') {
                $letters .= mb_strtoupper(mb_substr($part, 0, 1));
            }
        }

        return $letters !== '' ? $letters : '?';
    }
}
