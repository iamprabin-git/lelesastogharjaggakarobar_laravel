<?php

namespace App\Notifications;

use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PropertyApproved extends Notification
{
    use Queueable;

    public function __construct(public Property $property) {}

    public function via($notifiable)
    {
        return ['database', 'mail']; // adjust as needed
    }

    public function toArray($notifiable)
    {
        return [
            'property_id' => $this->property->id,
            'title'       => $this->property->title,
            'message'     => 'Your property has been approved.',
        ];
    }

    // Optional: add toMail() method for email
}
