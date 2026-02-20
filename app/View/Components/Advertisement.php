<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Advertisement as AdvertisementModel;

class Advertisement extends Component
{
    public $advertisements;

    public function __construct()
    {
        $this->advertisements = AdvertisementModel::where('is_active', true)
    ->where(function ($query) {
        $query->whereNull('expiry_date')
              ->orWhere('expiry_date', '>=', now());
    })
    ->get();
    }

    public function render()
    {
        return view('components.advertisement');
    }
}
