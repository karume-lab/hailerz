<x-mail::message>
<div style="text-align: center; padding: 20px 0;">
<img src="{{ $message->embed(public_path('images/logo.webp')) }}" width="160" alt="Hailerz Logo" style="display: block; margin: 0 auto;">
</div>

# Booking Inquiry Received

Hi {{ $inquiry->first_name }},

Thank you for choosing **Hailerz**. We have successfully received your booking inquiry for the following event:

**Event Type:** {{ $inquiry->event_type }}  
**Event Date:** {{ $inquiry->event_date->format('M d, Y') }}

Please find the attached PDF containing the full details of your submission. Our team will review your request and get back to you within one business day with a formal proposal.

If you have any immediate questions, feel free to reply to this email.

Best regards,  
**The Hailerz Team**
</x-mail::message>
