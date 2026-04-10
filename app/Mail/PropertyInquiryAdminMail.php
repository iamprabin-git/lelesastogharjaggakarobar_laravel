<?php

namespace App\Mail;

use App\Filament\Resources\PropertyInquiries\PropertyInquiryResource;
use App\Models\PropertyInquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PropertyInquiryAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public PropertyInquiry $inquiry
    ) {
        $this->inquiry->loadMissing('property', 'agent');
    }

    public function envelope(): Envelope
    {
        $title = $this->inquiry->property?->title ?? 'General / no listing';
        $agent = $this->inquiry->agent?->name ?? '—';

        return new Envelope(
            subject: 'New property inquiry — '.$title.' (Agent: '.$agent.') — '.config('app.name'),
            replyTo: [
                new Address($this->inquiry->email, $this->inquiry->name),
            ],
        );
    }

    public function content(): Content
    {
        $leadUrl = PropertyInquiryResource::getUrl('edit', ['record' => $this->inquiry], true, 'admin');

        return new Content(
            view: 'mail.property_inquiry_admin',
            with: [
                'leadUrl' => $leadUrl,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
