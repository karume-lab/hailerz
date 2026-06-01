@extends('pdf.layout')

@section('content')
<div class="section" style="text-align: center; border: 2px solid #223757; padding: 25px; border-radius: 10px; background-color: #fff;">
    <div style="font-size: 22px; font-weight: bold; color: #223757; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px;">
        Official Event Access Ticket
    </div>
    <div style="font-size: 14px; color: #666; margin-bottom: 25px;">
        Hailerz Event & Conference Expo
    </div>

    <table style="width: 100%; text-align: left; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 20px;">
        <tr>
            <td class="label" style="font-weight: bold; width: 30%; color: #555; padding: 8px 0;">Attendee Name:</td>
            <td style="padding: 8px 0; font-size: 15px; font-weight: bold;">{{ $registration->user->name }}</td>
        </tr>
        <tr>
            <td class="label" style="font-weight: bold; color: #555; padding: 8px 0;">Email Address:</td>
            <td style="padding: 8px 0;">{{ $registration->user->email }}</td>
        </tr>
        <tr>
            <td class="label" style="font-weight: bold; color: #555; padding: 8px 0;">Pass Tier:</td>
            <td style="padding: 8px 0;">
                <span class="badge" style="display: inline-block; padding: 6px 12px; background: #223757; color: #fff; border-radius: 4px; font-size: 12px; font-weight: bold; text-transform: uppercase;">
                    {{ $registration->pass_type === 'exhibitor' ? 'Corporate Exhibitor' : 'General Attendee' }}
                </span>
            </td>
        </tr>
        @if($registration->pass_type === 'exhibitor')
        <tr>
            <td class="label" style="font-weight: bold; color: #555; padding: 8px 0;">Company Name:</td>
            <td style="padding: 8px 0; font-weight: bold; color: #223757;">{{ $registration->company_name }}</td>
        </tr>
        @if($registration->company_description)
        <tr>
            <td class="label" style="font-weight: bold; color: #555; padding: 8px 0;">Description:</td>
            <td style="padding: 8px 0; font-size: 13px; color: #444;">{{ $registration->company_description }}</td>
        </tr>
        @endif
        @endif
        <tr>
            <td class="label" style="font-weight: bold; color: #555; padding: 8px 0;">Registration Date:</td>
            <td style="padding: 8px 0;">{{ $registration->created_at->format('F d, Y') }}</td>
        </tr>
    </table>

    @if($registration->pass_type === 'exhibitor')
        <div style="margin: 20px 0; text-align: center;">
            <span style="font-size: 12px; color: #777; display: block; margin-bottom: 8px;">Exhibitor Brand Asset</span>
            @if($registration->company_logo)
                <img src="{{ $registration->company_logo }}" style="max-height: 60px; max-width: 180px; object-contain; border: 1px solid #ddd; padding: 4px; background: #fff; border-radius: 4px;" alt="Logo">
            @else
                @php
                    $words = explode(' ', $registration->company_name);
                    $initials = '';
                    foreach ($words as $w) {
                        $initials .= strtoupper(substr($w, 0, 1));
                    }
                    $initials = substr($initials, 0, 3) ?: 'EXH';
                @endphp
                <div style="display: inline-block; width: 60px; height: 60px; line-height: 60px; border-radius: 8px; background-color: #223757; color: #fff; font-size: 20px; font-weight: bold; text-align: center; letter-spacing: 1px; border: 2px solid #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    {{ $initials }}
                </div>
            @endif
        </div>
    @endif

    <div style="margin-top: 30px; border-top: 2px dashed #223757; padding-top: 20px; text-align: center;">
        <div style="font-family: monospace; font-size: 22px; letter-spacing: 2px; color: #000; line-height: 1;">
            |||||||| | |||| || |||||| | ||| |||| | ||||| | ||
        </div>
        <div style="font-family: monospace; font-size: 11px; color: #555; margin-top: 5px; letter-spacing: 3px;">
            HLZ-EVT-{{ str_pad($registration->id, 8, '0', STR_PAD_LEFT) }}
        </div>
    </div>
</div>

<div style="margin-top: 15px; font-size: 11px; color: #777; text-align: center;">
    Please present this ticket on your device or as a printout at the main registration desk.
</div>
@endsection
