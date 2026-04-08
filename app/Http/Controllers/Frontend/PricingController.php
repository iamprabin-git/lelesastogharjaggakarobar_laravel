<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class PricingController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Pricing');
    }
}
