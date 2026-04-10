<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SiteContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array{name: string, email: string, phone: ?string, message: string}  $payload
     */
    public function __construct(
        public array $payload,
        public ?string $adminViewUrl = null,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Website contact: '.$this->payload['name'].' — '.config('app.name'),
            replyTo: [
                new Address($this->payload['email'], $this->payload['name']),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.site_contact_form',
            with: [
                'adminViewUrl' => $this->adminViewUrl,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
