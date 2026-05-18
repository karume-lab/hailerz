<?php

namespace App\Mail;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminBookingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Inquiry $inquiry
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Talent Booking Inquiry: ' . $this->inquiry->event_type,
            replyTo: [
                new \Illuminate\Mail\Mailables\Address($this->inquiry->email, $this->inquiry->first_name . ' ' . $this->inquiry->last_name),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.admin.booking-notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
