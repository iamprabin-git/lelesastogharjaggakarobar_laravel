<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use App\Models\AboutService;
use App\Models\TeamMember;
use App\Support\AboutPageData;
use Inertia\Inertia;

class AboutController extends Controller
{
    public function index()
    {
        $services = AboutService::query()
            ->active()
            ->ordered()
            ->get(['id', 'title', 'description', 'icon'])
            ->map(fn (AboutService $s) => [
                'id' => $s->id,
                'title' => $s->title,
                'description' => $s->description,
                'icon' => $s->icon,
            ])
            ->values()
            ->all();

        $teamMembers = TeamMember::query()
            ->where('is_active', true)
            ->orderBy('id')
            ->get()
            ->map(fn (TeamMember $m) => [
                'id' => $m->id,
                'name' => $m->name,
                'position' => $m->position,
                'bio' => $m->bio,
                'photo' => $m->photo ? asset('storage/'.$m->photo) : null,
                'facebook' => $m->facebook,
                'whatsapp' => $m->whatsapp,
                'instagram' => $m->instagram,
                'tiktok' => $m->tiktok,
                'linkedin' => $m->linkedin,
                'email' => $m->email,
                'phone' => $m->phone,
            ])
            ->values()
            ->all();

        return Inertia::render('About', [
            'about' => AboutPageData::inertia(AboutSection::first()),
            'services' => $services,
            'teamMembers' => $teamMembers,
        ]);
    }
}
