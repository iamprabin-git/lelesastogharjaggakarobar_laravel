<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminAgentCreatedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public array $data
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New agent account created (admin)',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.admin_agent_created',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
