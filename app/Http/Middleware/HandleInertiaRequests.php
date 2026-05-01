<?php

namespace App\Http\Middleware;

use App\Models\Company;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        $company = Company::where('status', true)->first();

        $webUser = $request->user();

        $recentPropertySearches = [];
        if ($webUser) {
            $recentPropertySearches = $webUser
                ->propertySearches()
                ->latest()
                ->limit(8)
                ->get()
                ->map(static fn ($s) => [
                    'id' => $s->id,
                    'label' => $s->summaryLabel(),
                    'params' => $s->queryParams(),
                ])
                ->values()
                ->all();
        }

        return [
            ...parent::share($request),
            'recent_property_searches' => $recentPropertySearches,
            'auth' => [
                'user' => $webUser ? [
                    'id' => $webUser->id,
                    'name' => $webUser->name,
                    'email' => $webUser->email,
                    'email_verified_at' => $webUser->email_verified_at?->toAtomString(),
                    'avatar_url' => $webUser->avatar
                        ? Storage::disk('public')->url($webUser->avatar)
                        : null,
                ] : null,
                'agent' => ($agent = Auth::guard('agent')->user()) ? [
                    'id' => $agent->id,
                    'name' => $agent->name,
                    'email' => $agent->email,
                    'avatar_url' => $agent->avatar ? Storage::disk('public')->url($agent->avatar) : null,
                ] : null,
                'admin' => ($admin = Auth::guard('admin')->user()) ? [
                    'id' => $admin->id,
                    'name' => $admin->name,
                    'email' => $admin->email,
                    'avatar_url' => null,
                ] : null,
                'unread_messages_count' => $request->user()
                    ? Conversation::unreadAdminMessagesCountForUser($request->user())
                    : 0,
            ],
            'flash' => [
                'success' => $request->session()->get('success'),
                'error' => $request->session()->get('error'),
                'status' => $request->session()->get('status'),
            ],
            'company' => $company ? [
                'name' => $company->name,
                'email' => $company->email,
                'phone' => $company->phone,
                'logo' => $company->logo ? asset('storage/'.$company->logo) : null,
                'facebook' => $company->facebook,
                'instagram' => $company->instagram,
                'youtube' => $company->youtube,
                'tiktok' => $company->tiktok,
                'whatsapp' => $company->whatsapp,
                'address' => $company->address,
                'primary_color' => $company->primary_color,
                'secondary_color' => $company->secondary_color,
            ] : null,
        ];
    }
}
