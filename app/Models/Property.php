<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'type',
        'status',
        'availability',
        'bedrooms',
        'bathrooms',
        'area',
        'location',
        'city',
        'state',
        'country',
        'images',
        'youtube_link',
        'latitude',
        'longitude',
        'agent_id',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    // Scope for approved properties

    public function scopeAvailable($query)
{
    return $query->where('availability', 'available');
}

public function scopeSold($query)
{
    return $query->where('availability', 'sold');
}

public function scopeRented($query)
{
    return $query->where('availability', 'rented');
}

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class)
                    ->withPivot('distance', 'unit')
                    ->withTimestamps();
    }

    public function getFirstImageUrlAttribute()
    {
        return isset($this->images[0])
            ? asset('storage/'.$this->images[0])
            : asset('images/placeholder.png');
    }
}
