<?php

namespace App\Mail;

use App\Models\Inquiry;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingConfirmationMail extends Mailable
{
    use SerializesModels;

    public $inquiry;

    /**
     * Create a new message instance.
     */
    public function __construct(Inquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Your Hailerz Booking Inquiry - {$this->inquiry->event_type}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.booking-confirmation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $pdf = Pdf::loadView('pdf.booking-inquiry', ['inquiry' => $this->inquiry]);
        $pdfContent = $pdf->output();

        $logoPath = public_path('images/logo.webp');
        
        return [
            Attachment::fromData(fn () => $pdfContent, 'Hailerz-Booking-Details.pdf')
                ->withMime('application/pdf'),
            Attachment::fromPath($logoPath)
                ->as('logo.webp')
                ->withMime('image/webp'),
        ];
    }
}
