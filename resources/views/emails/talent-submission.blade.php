<x-mail::message>
<div style="text-align: center; padding: 20px 0;">
<img src="{{ $message->embed(public_path('images/logo.webp')) }}" width="160" alt="Hailerz Logo" style="display: block; margin: 0 auto;">
</div>

# Talent Application Received

Hi {{ $submission->artist_name }},

Welcome to the **Hailerz** community! We have successfully received your application to join our exclusive talent network.

Attached to this email is a PDF summary of your professional details for your records. We are excited to review your portfolio and will reach out to you if your act is a fit for our roster.

In the meantime, feel free to update your portfolio link if anything changes.

Best regards,  
**The Hailerz Team**
</x-mail::message>
