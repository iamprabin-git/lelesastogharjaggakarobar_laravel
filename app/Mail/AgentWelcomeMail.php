<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AgentWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public array $data
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome — your agent account at '.config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.agent_welcome',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
