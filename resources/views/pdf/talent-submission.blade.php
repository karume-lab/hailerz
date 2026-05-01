@extends('pdf.layout')

@section('content')
<div class="section">
    <div class="section-title">Submission Details</div>
    <table>
        <tr>
            <td class="label">Submission ID:</td>
            <td>#{{ $submission->id }}</td>
        </tr>
        <tr>
            <td class="label">Submitted On:</td>
            <td>{{ $submission->created_at->format('M d, Y H:i') }}</td>
        </tr>
        <tr>
            <td class="label">Status:</td>
            <td><span class="badge">{{ ucfirst($submission->status) }}</span></td>
        </tr>
    </table>
</div>

<div class="section">
    <div class="section-title">Artist Information</div>
    <table>
        <tr>
            <td class="label">Artist/Stage Name:</td>
            <td>{{ $submission->artist_name }}</td>
        </tr>
        <tr>
            <td class="label">Real Name:</td>
            <td>{{ $submission->real_name }}</td>
        </tr>
        <tr>
            <td class="label">Email Address:</td>
            <td>{{ $submission->email }}</td>
        </tr>
        <tr>
            <td class="label">Phone Number:</td>
            <td>{{ $submission->phone }}</td>
        </tr>
        <tr>
            <td class="label">Location:</td>
            <td>{{ $submission->location }}</td>
        </tr>
        <tr>
            <td class="label">Category & Genre:</td>
            <td>{{ $submission->category }} @if($submission->genre) ({{ $submission->genre }}) @endif</td>
        </tr>
        <tr>
            <td class="label">Years Active:</td>
            <td>{{ $submission->years_active }}</td>
        </tr>
    </table>
</div>

<div class="section">
    <div class="section-title">Rates & Professional Info</div>
    <table>
        <tr>
            <td class="label">Rate Range:</td>
            <td>₦{{ number_format($submission->min_rate, 2) }} - ₦{{ number_format($submission->max_rate, 2) }}</td>
        </tr>
        @if($submission->website_url)
        <tr>
            <td class="label">Website:</td>
            <td><a href="{{ $submission->website_url }}" style="color: #223757; text-decoration: none;">{{ $submission->website_url }}</a></td>
        </tr>
        @endif
        @if($submission->instagram_handle)
        @php $igUrl = str_starts_with($submission->instagram_handle, 'http') ? $submission->instagram_handle : 'https://instagram.com/' . ltrim($submission->instagram_handle, '@'); @endphp
        <tr>
            <td class="label">Instagram:</td>
            <td><a href="{{ $igUrl }}" style="color: #223757; text-decoration: none;">{{ $submission->instagram_handle }}</a></td>
        </tr>
        @endif
        @if($submission->facebook_url)
        <tr>
            <td class="label">Facebook:</td>
            <td><a href="{{ $submission->facebook_url }}" style="color: #223757; text-decoration: none;">{{ $submission->facebook_url }}</a></td>
        </tr>
        @endif
        @if($submission->youtube_channel)
        <tr>
            <td class="label">YouTube:</td>
            <td><a href="{{ $submission->youtube_channel }}" style="color: #223757; text-decoration: none;">{{ $submission->youtube_channel }}</a></td>
        </tr>
        @endif
        @if($submission->tiktok_handle)
        @php $tiktokUrl = str_starts_with($submission->tiktok_handle, 'http') ? $submission->tiktok_handle : 'https://tiktok.com/@' . ltrim($submission->tiktok_handle, '@'); @endphp
        <tr>
            <td class="label">TikTok:</td>
            <td><a href="{{ $tiktokUrl }}" style="color: #223757; text-decoration: none;">{{ $submission->tiktok_handle }}</a></td>
        </tr>
        @endif
    </table>
</div>

<div class="section">
    <div class="section-title">Biography</div>
    <div style="background: #f9f9f9; padding: 15px; border-radius: 5px;">
        {!! nl2br(e($submission->bio)) !!}
    </div>
</div>

@if($submission->notable_venues || $submission->notable_clients)
<div class="section">
    <div class="section-title">Experience</div>
    @if($submission->notable_venues)
    <p><strong>Notable Venues:</strong> {{ $submission->notable_venues }}</p>
    @endif
    @if($submission->notable_clients)
    <p><strong>Notable Clients:</strong> {{ $submission->notable_clients }}</p>
    @endif
</div>
@endif

@if($submission->gallery->count() > 0)
<div class="section">
    <div class="section-title">Portfolio/Gallery Links</div>
    <ul>
        @foreach($submission->gallery as $item)
            <li>{{ $item->url }}</li>
        @endforeach
    </ul>
</div>
@endif

@if($submission->motivation)
<div class="section">
    <div class="section-title">Motivation</div>
    <p>{{ $submission->motivation }}</p>
</div>
@endif

@endsection
