<x-mail::message>
# New Talent Submission

A new talent application has been received.

**Artist Name:** {{ $submission->artist_name }}  
**Real Name:** {{ $submission->real_name }}  
**Email:** {{ $submission->email }}  
**Phone:** {{ $submission->phone }}  
**Location:** {{ $submission->location }}

**Professional Info:**
- **Category:** {{ $submission->category }}
- **Years Active:** {{ $submission->years_active }}
- **Rate Range:** ₦{{ number_format($submission->min_rate) }} - ₦{{ number_format($submission->max_rate) }}

<x-mail::button :url="config('app.url') . '/admin/submissions/' . $submission->id">
Review Application
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
