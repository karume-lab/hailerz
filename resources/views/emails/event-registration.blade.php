<x-mail::message>
<div style="text-align: center; padding: 20px 0;">
<img src="{{ $message->embed(public_path('images/logo.webp')) }}" width="160" alt="Hailerz Logo" style="display: block; margin: 0 auto;">
</div>

# Event Registration Confirmed

Hi {{ $registration->user->name }},

Thank you for registering for the Hailerz Event & Conference Expo. We are thrilled to confirm your registration. Here are the details of your registration:

### Pass Details
- **Pass Type:** {{ $registration->pass_type === 'exhibitor' ? 'Corporate Exhibitor Booth' : 'General Attendee' }}
- **Registrant Name:** {{ $registration->user->name }}
- **Registrant Email:** {{ $registration->user->email }}

@if($registration->pass_type === 'exhibitor')
### Corporate Profile
- **Company Name:** {{ $registration->company_name }}
- **Company Description:** {{ $registration->company_description }}
@endif

### Transaction Information
- **Total Amount:** {{ number_format($registration->total_amount, 2) }} NGN
- **Payment Status:** {{ ucfirst($registration->payment_status) }}
@if($registration->payment_reference)
- **Payment Reference:** {{ $registration->payment_reference }}
@endif

---

## Action Required

Please find attached two custom PDF files:
1. **Hailerz-Event-Access-Ticket.pdf**: Your entrance pass to the expo hall. Keep this ticket on your device or printed for scanning.
2. **Hailerz-Payment-Receipt.pdf**: Your official itemized payment receipt for tax and business records.

Best regards,  
**The Hailerz Team**
</x-mail::message>
