<x-mail::message>
<div style="text-align: center; padding: 20px 0;">
<img src="{{ $message->embed(public_path('images/logo.webp')) }}" width="160" alt="Hailerz Logo" style="display: block; margin: 0 auto;">
</div>

# Signature Required

You have been requested to electronically sign a document.

<x-mail::panel>
**Document Name:** {{ basename($contract->file_path) }}  
**Your Role:** {{ $signature->signer_role }}  
**Version:** {{ $contract->version }}
</x-mail::panel>

Please click the secure, cryptographically-signed button below to review and sign this document. This link is unique to you and will expire automatically.

<x-mail::button :url="$signedUrl" color="primary">
Review & Sign Document
</x-mail::button>

*Security Tip: If you cannot click the button above, copy and paste this URL into your browser:*  
[{{ $signedUrl }}]({{ $signedUrl }})

Best regards,  
**The Hailerz Team**
</x-mail::message>
