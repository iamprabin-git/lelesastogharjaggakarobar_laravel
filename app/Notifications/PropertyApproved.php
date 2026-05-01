<?php

namespace App\Notifications;

use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
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
            'title' => $this->property->title,
            'message' => 'Your property has been approved.',
        ];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your listing was approved')
            ->line('Good news — «'.$this->property->title.'» has been approved and can appear on the site.')
            ->action('Open agent panel', url('/agent'));
    }
}
