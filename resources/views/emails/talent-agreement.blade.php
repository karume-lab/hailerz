<x-mail::message>
<div style="text-align: center; padding: 20px 0;">
<img src="{{ $message->embed(public_path('images/logo.webp')) }}" width="160" alt="Hailerz Logo" style="display: block; margin: 0 auto;">
</div>

# Talent Representation Agreement

Hi {{ $talent->name }},

Congratulations! We are pleased to inform you that your application to join **Hailerz** has been accepted.

To finalize your onboarding and have your profile listed on our public directory, you are required to review and sign our digital **Talent Representation Agreement**.

<x-mail::button :url="$signedUrl" color="primary">
Review & Sign Agreement
</x-mail::button>

### How it works:
1. Click the button above to access your secure, personalized digital signature portal.
2. Review the terms of the representation contract online.
3. Type your full name and check the consent box to sign instantly. No printer or scanner needed!

Once signed, a copy of the fully executed agreement will be emailed to you, and your profile will automatically go live on our booking directory.

We are excited to have you on board!

Best regards,  
**The Hailerz Team**
</x-mail::message>
