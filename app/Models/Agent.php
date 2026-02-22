<?php

namespace App\Models;

use App\Models\Property;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Agent extends Authenticatable implements FilamentUser
{
    use Notifiable;
    // Add ALL fields that will be updated via forms or Filament
    protected $fillable = [
        'name',
        'email',
        'phone',
        'avatar',   // for uploaded image
        'status',   // for toggle Active/Inactive
        'expiry_date',
        'password',
        'email_verified_at',
    ];

    protected $casts = [
        'status' => 'boolean',
        'expiry_date' => 'date',
        'email_verified_at' => 'datetime',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
}
