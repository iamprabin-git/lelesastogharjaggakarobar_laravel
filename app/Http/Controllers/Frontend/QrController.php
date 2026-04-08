<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class QrController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Qr');
    }
}
