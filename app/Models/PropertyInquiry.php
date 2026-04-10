<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'agent_id',
        'name',
        'email',
        'phone',
        'lead_source',
        'message',
        'is_read',
        'crm_status',
        'admin_notes',
        'agent_notes',
        'deal_value',
        'expected_close_date',
        'next_follow_up_at',
        'lost_reason',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'deal_value' => 'decimal:2',
        'expected_close_date' => 'date',
        'next_follow_up_at' => 'datetime',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
