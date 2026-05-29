<?php

namespace App\Mail;

use App\Models\Talent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TalentFrozenMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Talent $talent
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Important: Your Hailerz Profile has been Frozen',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.talent-frozen',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
