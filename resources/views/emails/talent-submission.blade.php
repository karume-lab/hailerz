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
- **Experience:** {{ $submission->period_active }}
- **Rate Range:** {{ \App\Helpers\CurrencyHelper::formatRange($submission->min_rate, $submission->max_rate, $submission->currency ?? 'USD') }}

### Online Presence
@if($submission->instagram_handle)- **Instagram:** {{ $submission->instagram_handle }}@endif
@if($submission->youtube_channel)- **YouTube:** {{ $submission->youtube_channel }}@endif
@if($submission->website_url)- **Website:** {{ $submission->website_url }}@endif

---

## What Happens Next?

1. **Profile Review**: Our team will carefully review your application against our current roster needs and client requirements.
2. **Representation Contract**: If your profile is a strong fit, you will receive a formal representation contract to review and sign, formalising your commitment to the Hailerz network.
3. **Go Live**: Once your contract is countersigned, your profile will be published on the platform and made publicly available for booking by our premium clients.

---

### Important: Reliability & No-Show Policy
To maintain our reputation for premium service, we enforce a strict reliability policy. Any artist who accumulates **three (3) No-Show reports within a 12-month period** will have their profile **frozen**. A frozen profile remains viewable for portfolio purposes but is disabled for all future bookings. We value your professionalism and commitment to our clients.

---

Attached to this email is a PDF summary of your full application for your records.

---

**Privacy Note:** Your data is used strictly for recruitment and contact purposes. We do not sell or share your professional information with third parties outside of potential booking inquiries.

Best regards,  
**The Hailerz Team**
</x-mail::message>
