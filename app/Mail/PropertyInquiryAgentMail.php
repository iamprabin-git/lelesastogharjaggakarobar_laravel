<?php

namespace App\Mail;

use App\Filament\Agent\Resources\LandLeads\LandLeadResource;
use App\Models\PropertyInquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PropertyInquiryAgentMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public PropertyInquiry $inquiry
    ) {
        $this->inquiry->loadMissing('property', 'agent');
    }

    public function envelope(): Envelope
    {
        $title = $this->inquiry->property?->title ?? 'your listing';

        return new Envelope(
            subject: 'New inquiry: '.$title.' — '.config('app.name'),
            replyTo: [
                new Address($this->inquiry->email, $this->inquiry->name),
            ],
        );
    }

    public function content(): Content
    {
        $leadUrl = LandLeadResource::getUrl('edit', ['record' => $this->inquiry], true, 'agent');

        return new Content(
            view: 'mail.property_inquiry_agent',
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
