<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutSection; // ✅ import the correct model

class AboutController extends Controller
{
    public function index()
    {
        $about = AboutSection::first(); // ✅ use AboutSection model

        return view('frontend.about', compact('about'));
    }
}
