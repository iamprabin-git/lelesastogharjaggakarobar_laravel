<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'link', 'image', 'is_active', 'expiry_date'
    ];

    protected $dates = ['expiry_date'];
}
