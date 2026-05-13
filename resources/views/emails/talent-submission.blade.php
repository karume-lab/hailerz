<x-mail::message>
<div style="text-align: center; padding: 20px 0;">
<img src="{{ $message->embed(public_path('images/logo.webp')) }}" width="160" alt="Hailerz Logo" style="display: block; margin: 0 auto;">
</div>

# Talent Application Received

Hi {{ $submission->artist_name }},

Welcome to the **Hailerz** community! We have successfully received your application to join our exclusive talent network. Here is a summary of the professional profile you submitted:

### Professional Profile
- **Act Name:** {{ $submission->artist_name }}
- **Type:** {{ ucfirst($submission->talent_type) }} @if($submission->talent_type === 'group')({{ $submission->member_count }} members)@endif
- **Category:** {{ $submission->category }}
- **Location:** {{ $submission->location }}
- **Experience:** {{ $submission->years_active }}
- **Rate Range:** ₦{{ number_format($submission->min_rate) }} - ₦{{ number_format($submission->max_rate) }}

### Online Presence
@if($submission->instagram_handle)- **Instagram:** {{ $submission->instagram_handle }}@endif
@if($submission->youtube_channel)- **YouTube:** {{ $submission->youtube_channel }}@endif
@if($submission->website_url)- **Website:** {{ $submission->website_url }}@endif

---

## What Happens Next?

1. **Portfolio Review**: Our talent scouts will carefully review your credentials and media portfolio. This typically takes **5-7 business days**.
2. **Discovery Call**: If your act is a fit for our current roster needs, we will reach out to schedule a brief virtual discovery call to get to know you better.
3. **Onboarding**: Once approved, you'll be officially onboarded to the Hailerz platform and made available for bookings with our premium clients.

Attached to this email is a PDF summary of your full application for your records.

---

**Privacy Note:** Your data is used strictly for recruitment and contact purposes. We do not sell or share your professional information with third parties outside of potential booking inquiries.

Best regards,  
**The Hailerz Team**
</x-mail::message>
