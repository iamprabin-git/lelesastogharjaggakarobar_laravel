<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'is_read',
        'email_sent_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'email_sent_at' => 'datetime',
    ];
}
