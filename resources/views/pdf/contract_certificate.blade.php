<div style="page-break-before: always; font-family: 'DejaVu Sans', sans-serif; padding: 40px; color: #111827;">
    
    <div style="margin-bottom: 50px;">
        <h2 style="color: #223757; font-size: 20px; text-transform: uppercase; margin: 0;">Agreement Signature</h2>
        <p style="color: #6b7280; font-size: 12px; margin-top: 5px;">This document is signed electronically and is legally binding.</p>
    </div>

    <div style="display: block; margin-top: 20px;">
        @foreach($signatures as $sig)
            <div style="margin-bottom: 40px; border-bottom: 1px solid #e5e7eb; padding-bottom: 20px;">
                <div style="font-weight: bold; color: #223757; font-size: 14px; margin-bottom: 10px;">
                    {{ strtoupper($sig->signer_role) }}
                </div>
                <div style="font-size: 16px; font-weight: bold; color: #111827; margin-bottom: 5px;">
                    {{ $sig->signer_identifier }}
                </div>
                <div style="font-size: 11px; color: #6b7280; font-style: italic;">
                    Signed electronically on {{ $sig->signed_at ? $sig->signed_at->toDayDateTimeString() : 'Pending' }}
                </div>
                <div style="font-size: 10px; color: #9ca3af; margin-top: 5px; font-family: monospace;">
                    IP: {{ $sig->ip_address ?? 'N/A' }}
                </div>
            </div>
        @endforeach
    </div>

    <div style="margin-top: 60px; font-size: 9px; color: #6b7280; line-height: 1.5; border-top: 1px solid #e5e7eb; padding-top: 20px;">
        <strong>ESIGN Consent:</strong> By signing electronically, the parties above agree to do business via this digital platform. This electronic signature carries the same legal weight as a wet-ink signature in accordance with the ESIGN Act and UETA. The integrity of this contract is protected by cryptographic hashing.
    </div>
</div>