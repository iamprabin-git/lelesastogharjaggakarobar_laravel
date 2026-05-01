<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class Agent extends Authenticatable implements FilamentUser
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'avatar',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'status',
        'expiry_date',
        'password',
        'email_verified_at',
    ];

    protected $casts = [
        'status' => 'boolean',
        'expiry_date' => 'date',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Whether the agent is allowed to operate (admin-approved).
     */
    public function isActive(): bool
    {
        $status = $this->status;

        if ($status === true || $status === 1 || $status === '1') {
            return true;
        }

        if ($status === false || $status === 0 || $status === '0' || $status === null) {
            return false;
        }

        return filter_var($status, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Expiry is inclusive for the calendar day stored in expiry_date.
     */
    public function isAccessExpired(): bool
    {
        if ($this->expiry_date === null) {
            return false;
        }

        $expiry = $this->expiry_date instanceof Carbon
            ? $this->expiry_date->copy()->startOfDay()
            : Carbon::parse($this->expiry_date)->startOfDay();

        return now()->startOfDay()->gt($expiry);
    }

    public function canAccessAgentPanel(): bool
    {
        return $this->isActive() && ! $this->isAccessExpired();
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $panel->getId() === 'agent' && $this->canAccessAgentPanel();
    }

    /**
     * Agents shown on the public directory (footer / agent cards): active and not past expiry.
     *
     * @param  Builder<Agent>  $query
     */
    public function scopePublicDirectory(Builder $query): void
    {
        $query->where('status', true)
            ->where(function ($q): void {
                $q->whereNull('expiry_date')
                    ->orWhereDate('expiry_date', '>=', now()->toDateString());
            });
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    public function propertyInquiries(): HasMany
    {
        return $this->hasMany(PropertyInquiry::class);
    }
}
