@extends('pdf.layout')

@section('content')
<div class="section">
    <div class="section-title">Reference Details</div>
    <table>
        <tr>
            <td class="label">Inquiry ID:</td>
            <td>#{{ $inquiry->id }}</td>
        </tr>
        <tr>
            <td class="label">Submitted On:</td>
            <td>{{ $inquiry->created_at->format('M d, Y H:i') }}</td>
        </tr>
        <tr>
            <td class="label">Status:</td>
            <td><span class="badge">{{ ucfirst($inquiry->status->value ?? $inquiry->status) }}</span></td>
        </tr>
    </table>
</div>

<div class="section">
    <div class="section-title">Contact Information</div>
    <table>
        <tr>
            <td class="label">Full Name:</td>
            <td>{{ $inquiry->first_name }} {{ $inquiry->last_name }}</td>
        </tr>
        <tr>
            <td class="label">Email Address:</td>
            <td>{{ $inquiry->email }}</td>
        </tr>
        <tr>
            <td class="label">Phone Number:</td>
            <td>{{ $inquiry->phone }} {{ $inquiry->client_phone ? '/ '.$inquiry->client_phone : '' }}</td>
        </tr>
        @if($inquiry->company)
        <tr>
            <td class="label">Company:</td>
            <td>{{ $inquiry->company }}</td>
        </tr>
        @endif
    </table>
</div>

<div class="section">
    <div class="section-title">Event Details</div>
    <table>
        <tr>
            <td class="label">Event Type:</td>
            <td>{{ $inquiry->event_type }}</td>
        </tr>
        <tr>
            <td class="label">Event Date:</td>
            <td>{{ $inquiry->event_date->format('M d, Y') }}</td>
        </tr>
        <tr>
            <td class="label">Event Time:</td>
            <td>{{ $inquiry->event_time }}</td>
        </tr>
        <tr>
            <td class="label">Location:</td>
            <td>{{ $inquiry->venue_name ? $inquiry->venue_name . ', ' : '' }}{{ $inquiry->city }}, {{ $inquiry->state }}</td>
        </tr>
        <tr>
            <td class="label">Expected Guests:</td>
            <td>{{ $inquiry->expected_guests ?? $inquiry->estimated_attendance }}</td>
        </tr>
        <tr>
            <td class="label">Performance Duration:</td>
            <td>{{ $inquiry->performance_duration }}</td>
        </tr>
    </table>
</div>

<div class="section">
    <div class="section-title">Talent Preferences</div>
    <table>
        <tr>
            <td class="label">Category:</td>
            <td>{{ $inquiry->talent_category }}</td>
        </tr>
        @if($inquiry->preferred_genre)
        <tr>
            <td class="label">Preferred Genre:</td>
            <td>{{ $inquiry->preferred_genre }}</td>
        </tr>
        @endif
        @if($inquiry->specific_talent)
        <tr>
            <td class="label">Requested Talent:</td>
            <td>{{ $inquiry->specific_talent }}</td>
        </tr>
        @endif
        <tr>
            <td class="label">Budget Range:</td>
            <td>{{ $inquiry->budget_range }} {{ $inquiry->budget_flexible ? '(Flexible)' : '' }}</td>
        </tr>
    </table>
</div>

<div class="section">
    <div class="section-title">Additional Information</div>
    <div style="background: #f9f9f9; padding: 15px; border-radius: 5px;">
        {!! nl2br(e($inquiry->additional_details)) !!}
    </div>
</div>

@if($inquiry->source)
<div class="section">
    <div class="section-title">Referral Source</div>
    <p>How you heard about us: {{ $inquiry->source }}</p>
</div>
@endif

@endsection
