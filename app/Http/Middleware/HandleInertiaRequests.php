<?php

namespace App\Http\Middleware;

use App\Models\Company;
use App\Models\Conversation;
use Illuminate\Http\Request;
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

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user() ? [
                    'id' => $request->user()->id,
                    'name' => $request->user()->name,
                    'email' => $request->user()->email,
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
