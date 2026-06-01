<?php

namespace App\Mail;

use App\Models\EventRegistration;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EventRegistrationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public EventRegistration $registration;

    /**
     * Create a new message instance.
     */
    public function __construct(EventRegistration $registration)
    {
        $this->registration = $registration;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $passTypeLabel = $this->registration->pass_type === 'exhibitor' ? 'Corporate Exhibitor' : 'General Attendee';

        return new Envelope(
            subject: "Your Hailerz Event Registration Confirmation - {$passTypeLabel} Pass",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.event-registration',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        $ticketPdf = Pdf::loadView('pdf.event-ticket', ['registration' => $this->registration]);
        $receiptPdf = Pdf::loadView('pdf.event-receipt', ['registration' => $this->registration]);

        return [
            Attachment::fromData(fn () => $ticketPdf->output(), 'Hailerz-Event-Access-Ticket.pdf')
                ->withMime('application/pdf'),
            Attachment::fromData(fn () => $receiptPdf->output(), 'Hailerz-Payment-Receipt.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
