<?php

namespace App\Notifications;

use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PropertyRejected extends Notification
{
    use Queueable;

    public function __construct(public Property $property, public string $reason) {}

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toArray($notifiable)
    {
        return [
            'property_id' => $this->property->id,
            'title'       => $this->property->title,
            'reason'      => $this->reason,
            'message'     => 'Your property has been rejected.',
        ];
    }
}
