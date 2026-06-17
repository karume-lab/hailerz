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
- **Years Active:** {{ $submission->period_active }}
- **Rate Range:** {{ \App\Helpers\CurrencyHelper::formatRange($submission->min_rate, $submission->max_rate, $submission->currency ?? 'USD') }}

<x-mail::button :url="config('app.url') . '/admin/submissions/' . $submission->id . '/edit'">
Review Application
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
