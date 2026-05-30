<x-mail::message>
<div style="text-align: center; padding: 20px 0;">
<img src="{{ $message->embed(public_path('images/logo.webp')) }}" width="160" alt="Hailerz Logo" style="display: block; margin: 0 auto;">
</div>

# Booking Inquiry Received

Hi {{ $inquiry->first_name }},

Thank you for choosing **Hailerz**. We have successfully received your booking inquiry. Here is a summary of the details you provided:

### Contact Information
- **Name:** {{ $inquiry->first_name }} {{ $inquiry->last_name }}
- **Email:** {{ $inquiry->email }}
- **Phone:** {{ $inquiry->phone }}
@if($inquiry->company)- **Company:** {{ $inquiry->company }}@endif

### Event Details
- **Event Type:** {{ $inquiry->event_type }}  
- **Date:** {{ $inquiry->event_date->format('M d, Y') }}
- **Location:** {{ $inquiry->city }}, {{ $inquiry->state }}
@if($inquiry->venue_name)- **Venue:** {{ $inquiry->venue_name }}@endif
- **Expected Guests:** {{ $inquiry->expected_guests }}

### Talent Preferences
- **Category:** {{ $inquiry->talent_category }}
- **Preferred Budget:** {{ $inquiry->budget_range }}
@if($inquiry->specific_talent)- **Requested Talent:** {{ $inquiry->specific_talent }}@endif

---

## What Happens Next?

1. **Artist Verification**: Our team will immediately contact the requested talent to verify their availability for your date.
2. **Final Quotation**: We will obtain a final quote based on your specific event requirements and duration.
3. **Formal Proposal**: Expect to receive a formal proposal and final quote from the **Hailerz Team** within **{{ config('hailerz.response_time') }}**.

Please find the attached PDF containing the full details of your submission.

---

**Privacy Note:** Your information is used solely for contact purposes regarding this inquiry. We do not sell or share your data with third parties.

Best regards,  
**The Hailerz Team**
</x-mail::message>
