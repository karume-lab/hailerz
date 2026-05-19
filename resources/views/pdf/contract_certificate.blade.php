<div style="page-break-before: always; font-family: 'DejaVu Sans', sans-serif; padding: 40px; color: #1f2937;">
    <!-- Certificate Header -->
    <div style="border-bottom: 3px solid #2563eb; padding-bottom: 20px; margin-bottom: 30px;">
        <h1 style="color: #1e3a8a; font-size: 24px; margin: 0; text-transform: uppercase; letter-spacing: 1px;">Certificate of Completion</h1>
        <p style="color: #6b7280; font-size: 12px; margin: 5px 0 0 0;">Secure Digital Signature Audit Shield &bull; Natively Executed</p>
    </div>

    <!-- Contract Metadata Grid -->
    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin-bottom: 30px;">
        <h3 style="color: #1e3a8a; margin-top: 0; font-size: 14px; text-transform: uppercase;">Document Audit Info</h3>
        <table style="width: 100%; font-size: 12px; border-collapse: collapse;">
            <tr>
                <td style="padding: 6px 0; font-weight: bold; color: #475569; width: 25%;">Contract ID:</td>
                <td style="padding: 6px 0; color: #0f172a; font-family: monospace;">{{ $contract->id }}</td>
            </tr>
            <tr>
                <td style="padding: 6px 0; font-weight: bold; color: #475569;">Version:</td>
                <td style="padding: 6px 0; color: #0f172a;">{{ $contract->version }}</td>
            </tr>
            <tr>
                <td style="padding: 6px 0; font-weight: bold; color: #475569;">Status:</td>
                <td style="padding: 6px 0;">
                    <span style="background-color: #dcfce7; color: #166534; padding: 2px 8px; border-radius: 9999px; font-weight: bold; font-size: 11px;">
                        {{ strtoupper($contract->status) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td style="padding: 6px 0; font-weight: bold; color: #475569;">File Name:</td>
                <td style="padding: 6px 0; color: #0f172a;">{{ basename($contract->file_path) }}</td>
            </tr>
            <tr>
                <td style="padding: 6px 0; font-weight: bold; color: #475569;">SHA-256 Hash:</td>
                <td style="padding: 6px 0; color: #0f172a; font-family: monospace; word-break: break-all; font-size: 11px;">
                    {{ $contract->file_hash }}
                </td>
            </tr>
            <tr>
                <td style="padding: 6px 0; font-weight: bold; color: #475569;">Finalized At:</td>
                <td style="padding: 6px 0; color: #0f172a;">{{ now()->toDayDateTimeString() }}</td>
            </tr>
        </table>
    </div>

    <!-- Signer Audit Trail -->
    <div>
        <h3 style="color: #1e3a8a; margin-top: 0; font-size: 14px; text-transform: uppercase; margin-bottom: 15px;">Signatory Activity Log</h3>
        
        @foreach($signatures as $sig)
            <div style="border-left: 4px solid #2563eb; background-color: #fafafa; padding: 15px; margin-bottom: 15px; border-radius: 0 8px 8px 0; border-top: 1px solid #f0f0f0; border-right: 1px solid #f0f0f0; border-bottom: 1px solid #f0f0f0;">
                <table style="width: 100%; font-size: 11px; border-collapse: collapse;">
                    <tr>
                        <td style="width: 20%; font-weight: bold; color: #475569; padding: 4px 0;">Signer Role:</td>
                        <td style="color: #1e3a8a; font-weight: bold; padding: 4px 0; font-size: 12px;">{{ $sig->signer_role }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; color: #475569; padding: 4px 0;">Identifier:</td>
                        <td style="color: #0f172a; padding: 4px 0;">{{ $sig->signer_identifier }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; color: #475569; padding: 4px 0;">IP Address:</td>
                        <td style="color: #0f172a; padding: 4px 0; font-family: monospace;">{{ $sig->ip_address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; color: #475569; padding: 4px 0;">Token ID:</td>
                        <td style="color: #0f172a; padding: 4px 0; font-family: monospace;">{{ $sig->token_id ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; color: #475569; padding: 4px 0;">User Agent:</td>
                        <td style="color: #4b5563; padding: 4px 0;">{{ $sig->user_agent ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; color: #475569; padding: 4px 0;">Signed At:</td>
                        <td style="color: #166534; font-weight: bold; padding: 4px 0;">{{ $sig->signed_at ? $sig->signed_at->toDayDateTimeString() : 'Pending' }}</td>
                    </tr>
                </table>
            </div>
        @endforeach
    </div>

    <!-- Security/Legal Notice -->
    <div style="margin-top: 40px; border-top: 1px solid #e2e8f0; padding-top: 20px; font-size: 10px; color: #9ca3af; text-align: justify; line-height: 1.4;">
        <strong>ESIGN Act & UETA Compliance Statement:</strong> This document carries a legally binding electronic signature. By executing this signature via this digital contract portal, the signing parties acknowledge and agree to conduct transactions electronically in compliance with the Electronic Signatures in Global and National Commerce Act (ESIGN) and the Uniform Electronic Transactions Act (UETA). The cryptographic audit hashes and metadata recorded above provide immutable, secure confirmation of the identities of the signatories and the integrity of the content at the moment of execution.
    </div>
</div>
