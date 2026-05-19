@extends('pdf.layout')

@section('content')
<div class="section" style="text-align: center; margin-bottom: 40px;">
    <h2 style="color: #223757; font-size: 20px; text-transform: uppercase; margin-bottom: 5px;">Talent Representation Agreement</h2>
    <p style="font-size: 12px; color: #666; margin: 0;">Secure Digital Execution Copy</p>
</div>

<div class="section">
    <div class="section-title">1. The Parties</div>
    <p>This Talent Representation Agreement (the "Agreement") is entered into and made effective as of the date of final electronic execution, by and between:</p>
    <table style="margin-top: 15px;">
        <tr>
            <td class="label">Party A (Agency):</td>
            <td><strong>Hailerz Agency</strong><br>info@hailerz.com</td>
        </tr>
        <tr>
            <td class="label">Party B (Artist/Act):</td>
            <td><strong>{{ $talent->name }}</strong><br>{{ $talent->email }}<br>Location: {{ $talent->location ?? 'Not Specified' }}</td>
        </tr>
    </table>
</div>

<div class="section">
    <div class="section-title">2. Scope of Representation</div>
    <p>The Artist hereby appoints the Agency as their non-exclusive booking intermediary and representation partner for securing live performances, brand endorsements, appearances, and other booking opportunities. The Agency agrees to list the Artist on its premium public directory and actively promote their act to premium clients.</p>
</div>

<div class="section">
    <div class="section-title">3. Commission & Booking Fees</div>
    <p>For any bookings secured, negotiated, or facilitated through the Agency's platform or direct client outreach:</p>
    <ul>
        <li>The Agency shall be entitled to a commission of fifteen percent (15%) of the total gross performance fee agreed upon for the booking.</li>
        <li>Payouts to the Artist shall be processed securely within forty-eight (48) business hours following the successful completion of the booking and receipt of client funds.</li>
    </ul>
</div>

<div class="section">
    <div class="section-title">4. Term & Termination</div>
    <p>This Agreement shall remain in effect for an initial term of twelve (12) months from the signing date. It shall automatically renew for successive 12-month periods unless terminated by either party. Either party may terminate this Agreement at any time, with or without cause, by providing thirty (30) days written notice via email.</p>
</div>

<div class="section">
    <div class="section-title">5. Code of Conduct & Standards</div>
    <p>The Artist agrees to perform all bookings with high standards of professionalism, punctuality, and artistic integrity. Any no-show or material breach of booking agreements may result in immediate suspension, freezing of the talent profile, or permanent removal from the Hailerz platform.</p>
</div>

<div class="section">
    <div class="section-title">6. Electronic Execution & Consent</div>
    <p>By typing their full name and completing the digital signature process on the Hailerz portal, the Artist explicitly consents to be bound by the terms and conditions outlined in this Agreement. This electronic execution carries the same legal weight and validity as a physical, handwritten signature under standard ESIGN and UETA guidelines.</p>
</div>
@endsection
