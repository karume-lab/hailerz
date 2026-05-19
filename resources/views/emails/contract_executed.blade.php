<x-mail::message>
<div style="text-align: center; padding: 20px 0;">
<img src="{{ $message->embed(public_path('images/logo.webp')) }}" width="160" alt="Hailerz Logo" style="display: block; margin: 0 auto;">
</div>

# Document Fully Signed

All parties have successfully signed and completed the agreement.

<x-mail::panel>
**Document:** {{ basename($contract->file_path) }}  
**Status:** SIGNED  
**SHA-256 Hash:** {{ $contract->file_hash }}
</x-mail::panel>

We have attached the finalized PDF agreement to this email. It contains the legally binding "Certificate of Completion" audit page appended to the end, documenting all signatories, IP addresses, tokens, and timestamps.

Please download and save the attached file for your records. The document hash guarantees that the file has not been altered since signing.

Best regards,  
**The Hailerz Team**
</x-mail::message>
