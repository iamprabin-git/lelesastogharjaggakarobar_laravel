<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_description',
        'hero_image',
        'about_image',
        'experience_years',
        'properties_sold',
        'happy_clients',
        'mission',
        'vision',
    ];
}
