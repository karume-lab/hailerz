<?php

namespace App\Mail;

use App\Models\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminTalentSubmissionNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Submission $submission
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Talent Submission: '.$this->submission->artist_name,
            replyTo: [
                new Address($this->submission->email, $this->submission->real_name),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.admin.talent-submission-notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
