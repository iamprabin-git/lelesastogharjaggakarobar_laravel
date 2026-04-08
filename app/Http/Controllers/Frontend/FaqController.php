<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Inertia\Inertia;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::where('is_active', true)->latest()->get();

        return Inertia::render('Faqs', [
            'faqs' => $faqs
                ->map(fn (Faq $f) => [
                    'id' => $f->id,
                    'question' => $f->question,
                    'answer' => $f->answer,
                ])
                ->values()
                ->all(),
        ]);
    }
}
