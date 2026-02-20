<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
     protected $fillable = [
        'user_id',
        'plan_name',
        'amount',
        'payment_method',
        'transaction_id',
        'screenshot',
        'status',
    ];

public function user()
    {
        return $this->belongsTo(User::class);
    }
}
