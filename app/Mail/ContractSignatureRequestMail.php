<?php

namespace App\Mail;

use App\Models\Contract;
use App\Models\ContractSignature;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContractSignatureRequestMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Contract $contract;

    public ContractSignature $signature;

    public string $signedUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(Contract $contract, ContractSignature $signature, string $signedUrl)
    {
        $this->contract = $contract;
        $this->signature = $signature;
        $this->signedUrl = $signedUrl;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Signature Required: '.basename($this->contract->file_path),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contract_signature_request',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
