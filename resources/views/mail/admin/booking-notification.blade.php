<x-mail::message>
# New Talent Booking Inquiry

A new booking inquiry has been received.

**Customer:** {{ $inquiry->first_name }} {{ $inquiry->last_name }}  
**Email:** {{ $inquiry->email }}  
**Phone:** {{ $inquiry->phone }}

**Event Details:**
- **Type:** {{ $inquiry->event_type }}
- **Date:** {{ $inquiry->event_date->format('M d, Y') }}
- **Location:** {{ $inquiry->city }}, {{ $inquiry->state }}
- **Expected Guests:** {{ $inquiry->expected_guests }}

**Talent Request:**
- **Category:** {{ $inquiry->talent_category }}
- **Budget Range:** {{ $inquiry->budget_range }}
- **Specific Talent:** {{ $inquiry->specific_talent ?? 'None specified' }}

<x-mail::button :url="config('app.url') . '/admin/inquiries/' . $inquiry->id">
Review in Admin Panel
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
