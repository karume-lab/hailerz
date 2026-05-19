@extends('pdf.layout')

@section('content')
<div class="section" style="text-align: center; margin-bottom: 40px;">
    <h2 style="color: #223757; font-size: 20px; text-transform: uppercase; margin-bottom: 5px;">Talent Representation Agreement</h2>
    <p style="font-size: 12px; color: #666; margin: 0;">Secure Digital Signed Copy</p>
</div>

<div class="section">
    <div class="section-title">1. The Parties</div>
    <p>This Talent Representation Agreement (the "Agreement") is entered into and made effective as of the date of final electronic signature, by and between:</p>
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
    <div class="section-title">2. How We Work Together</div>
    <p>You (the Artist) appoint us (the Hailerz Agency) as your non-exclusive partner to help you find and secure live performances, endorsements, and appearances. We agree to feature your profile on our public directory and actively promote you to our clients.</p>
</div>

<div class="section">
    <div class="section-title">3. Commission & Getting Paid</div>
    <p>When we help you secure a booking through our platform or our direct outreach:</p>
    <ul>
        <li><strong>Our Commission:</strong> We earn a fifteen percent (15%) commission on the total performance fee we negotiate for you.</li>
        <li><strong>Your Payout:</strong> We will process your payment securely within forty-eight (48) business hours after the event is successfully completed and the client's funds have cleared.</li>
    </ul>
</div>

<div class="section">
    <div class="section-title">4. Partnership Duration & Cancellation</div>
    <p>Our partnership starts on the date you sign this and lasts for twelve (12) months. It will automatically renew each year. If either of us decides it is time to part ways, we can cancel this agreement at any time by giving a thirty (30) day written notice via email.</p>
</div>

<div class="section">
    <div class="section-title">5. Professional Standards</div>
    <p>We expect you to treat every booking with professionalism, punctuality, and artistic integrity. If you fail to show up for a booking or break our trust, we may suspend, freeze, or permanently remove your profile from the Hailerz platform.</p>
</div>

<div class="section">
    <div class="section-title">6. Digital Signatures</div>
    <p>By typing your name and completing the digital signature process on our portal, you agree to these terms. This digital signature is legally binding and carries the same weight as a physical, handwritten signature.</p>
</div>
@endsection
