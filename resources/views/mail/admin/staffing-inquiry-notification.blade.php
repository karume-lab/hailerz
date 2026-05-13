<x-mail::message>
# New Staffing Inquiry

You have received a new staffing inquiry from the website.

**Name:** {{ $inquiry->first_name }} {{ $inquiry->last_name }}  
**Email:** {{ $inquiry->email }}  
**Phone:** {{ $inquiry->phone ?? 'N/A' }}  
**Company:** {{ $inquiry->company ?? 'N/A' }}

**Needs:**  
{{ $inquiry->needs }}

<x-mail::button :url="config('app.url') . '/admin/staffing-inquiries/' . $inquiry->id">
View in Admin Panel
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
