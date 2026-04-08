<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Inertia\Inertia;

class StaticLegalController extends Controller
{
    public function privacy()
    {
        return Inertia::render('LegalPage', [
            'title' => 'Privacy Policy',
            'html' => View::make('inertia-content.privacy')->render(),
        ]);
    }

    public function terms()
    {
        return Inertia::render('LegalPage', [
            'title' => 'Terms & Conditions',
            'html' => View::make('inertia-content.terms')->render(),
        ]);
    }
}
