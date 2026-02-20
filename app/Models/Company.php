<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'logo',
        'facebook',
        'twitter',
        'youtube',
        'linkedin',
        'instagram',
        'tiktok',
        'primary_color',
        'secondary_color',
        'background_color',
        'text_color',
        'status',
    ];
}
