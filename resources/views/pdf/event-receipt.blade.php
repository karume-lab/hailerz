@extends('pdf.layout')

@section('content')
<div class="section" style="border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 25px;">
    <div style="font-size: 20px; font-weight: bold; color: #223757; text-transform: uppercase;">
        Payment Receipt
    </div>
    <table style="width: 100%; margin-top: 10px;">
        <tr>
            <td style="width: 50%;">
                <span style="font-size: 12px; color: #666; display: block;">Receipt Date:</span>
                <strong>{{ $registration->created_at->format('F d, Y') }}</strong>
            </td>
            <td style="width: 50%; text-align: right;">
                <span style="font-size: 12px; color: #666; display: block;">Receipt Reference:</span>
                <strong>{{ $registration->payment_reference ?: 'N/A' }}</strong>
            </td>
        </tr>
    </table>
</div>

<div class="section" style="margin-bottom: 30px;">
    <table style="width: 100%;">
        <tr>
            <td style="width: 50%; vertical-align: top;">
                <div style="font-size: 12px; color: #666; text-transform: uppercase; margin-bottom: 5px; font-weight: bold;">Billed To:</div>
                <div style="font-size: 14px; font-weight: bold;">{{ $registration->user->name ?? $registration->guest_name }}</div>
                <div style="font-size: 13px; color: #555;">{{ $registration->user->email ?? $registration->guest_email }}</div>
                @if($registration->company_name)
                    <div style="font-size: 13px; color: #555; margin-top: 4px;">{{ $registration->company_name }}</div>
                @endif
            </td>
            <td style="width: 50%; vertical-align: top; text-align: right;">
                <div style="font-size: 12px; color: #666; text-transform: uppercase; margin-bottom: 5px; font-weight: bold;">Merchant Details:</div>
                <div style="font-size: 14px; font-weight: bold; color: #223757;">Hailerz Ltd</div>
                <div style="font-size: 13px; color: #555;">Nairobi, Kenya</div>
                <div style="font-size: 13px; color: #555;">events@hailerz.com</div>
            </td>
        </tr>
    </table>
</div>

<div class="section" style="margin-bottom: 30px;">
    <div class="section-title" style="font-size: 14px; text-transform: uppercase; margin-bottom: 10px; border-bottom: 2px solid #223757; padding-bottom: 5px; font-weight: bold; color: #223757;">
        Itemized Charges
    </div>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 1px solid #ddd; background-color: #f9f9f9;">
                <th style="text-align: left; padding: 10px; font-size: 12px; color: #555; text-transform: uppercase;">Description</th>
                <th style="text-align: right; padding: 10px; font-size: 12px; color: #555; text-transform: uppercase; width: 30%;">Price</th>
            </tr>
        </thead>
        <tbody>
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 12px 10px; font-size: 14px;">
                    <div>{{ $registration->event->title ?? 'Hailerz Event & Conference Expo' }} Registration</div>
                    <div style="font-size: 11px; color: #666; margin-top: 3px;">
                        Pass Tier: {{ $registration->pass_type === 'exhibitor' ? 'Corporate Exhibitor Booth Space' : 'General Attendee Pass' }}
                    </div>
                </td>
                <td style="text-align: right; padding: 12px 10px; font-size: 14px; font-weight: bold; vertical-align: middle;">
                    {{ number_format($registration->total_amount, 2) }} NGN
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="section" style="width: 50%; float: right; margin-top: 10px; margin-bottom: 30px;">
    <table style="width: 100%;">
        <tr>
            <td style="padding: 6px 0; font-size: 13px; color: #666;">Subtotal:</td>
            <td style="text-align: right; padding: 6px 0; font-size: 13px; font-weight: bold;">
                {{ number_format($registration->total_amount / 1.075, 2) }} NGN
            </td>
        </tr>
        <tr>
            <td style="padding: 6px 0; font-size: 13px; color: #666;">VAT (7.5%):</td>
            <td style="text-align: right; padding: 6px 0; font-size: 13px; font-weight: bold;">
                {{ number_format($registration->total_amount - ($registration->total_amount / 1.075), 2) }} NGN
            </td>
        </tr>
        <tr style="border-top: 1px solid #ddd;">
            <td style="padding: 10px 0; font-size: 15px; font-weight: bold; color: #223757;">Total Paid:</td>
            <td style="text-align: right; padding: 10px 0; font-size: 16px; font-weight: bold; color: #223757;">
                {{ number_format($registration->total_amount, 2) }} NGN
            </td>
        </tr>
    </table>
</div>
<div style="clear: both;"></div>

<div class="section" style="text-align: center; margin-top: 40px; background-color: #f9f9f9; padding: 15px; border-radius: 6px; border: 1px solid #eee;">
    <span style="font-size: 12px; color: #666; display: block; margin-bottom: 4px; text-transform: uppercase; font-weight: bold;">Payment Status</span>
    <span style="font-size: 16px; font-weight: bold; color: #15803d; text-transform: uppercase;">
        {{ $registration->payment_status === 'confirmed' ? 'Confirmed / Paid' : ucfirst($registration->payment_status) }}
    </span>
</div>
@endsection
