<div style="page-break-before: always; font-family: 'DejaVu Sans', sans-serif; padding: 30px; color: #111827; clear: both;">
    <!-- Certificate Header -->
    <div style="border-bottom: 3px solid #223757; padding-bottom: 15px; margin-bottom: 25px;">
        <h1 style="color: #223757; font-size: 22px; margin: 0; text-transform: uppercase; letter-spacing: 1px; font-weight: bold;">Certificate of Completion</h1>
        <p style="color: #6b7280; font-size: 11px; margin: 5px 0 0 0; font-weight: bold; letter-spacing: 0.5px;">Secure Digital Signature Audit Shield &bull; Natively Executed</p>
    </div>

    <!-- Contract Metadata Grid -->
    <div style="background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 6px; padding: 18px; margin-bottom: 25px;">
        <h3 style="color: #223757; margin-top: 0; margin-bottom: 12px; font-size: 13px; text-transform: uppercase; font-weight: bold; letter-spacing: 0.5px;">Document Audit Info</h3>
        <table style="width: 100%; font-size: 11px; border-collapse: collapse;">
            <tr>
                <td style="padding: 5px 0; font-weight: bold; color: #4b5563; width: 22%;">Contract ID:</td>
                <td style="padding: 5px 0; color: #111827; font-family: monospace;">{{ $contract->id }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0; font-weight: bold; color: #4b5563;">Version:</td>
                <td style="padding: 5px 0; color: #111827;">v{{ $contract->version }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0; font-weight: bold; color: #4b5563;">Status:</td>
                <td style="padding: 5px 0;">
                    <span style="background-color: #dcfce7; color: #15803d; padding: 2px 8px; border-radius: 9999px; font-weight: bold; font-size: 10px; border: 1px solid #bbf7d0;">
                        {{ strtoupper($contract->status) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td style="padding: 5px 0; font-weight: bold; color: #4b5563;">File Name:</td>
                <td style="padding: 5px 0; color: #111827;">{{ basename($contract->file_path) }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0; font-weight: bold; color: #4b5563;">SHA-256 Hash:</td>
                <td style="padding: 5px 0; color: #111827; font-family: monospace; word-break: break-all; font-size: 10px; line-height: 1.3;">
                    {{ $contract->file_hash }}
                </td>
            </tr>
            <tr>
                <td style="padding: 5px 0; font-weight: bold; color: #4b5563;">Finalized At:</td>
                <td style="padding: 5px 0; color: #111827;">{{ now()->toDayDateTimeString() }}</td>
            </tr>
        </table>
    </div>

    <!-- Signer Audit Trail -->
    <div style="margin-bottom: 25px;">
        <h3 style="color: #223757; margin-top: 0; font-size: 13px; text-transform: uppercase; margin-bottom: 12px; font-weight: bold; letter-spacing: 0.5px;">Signatory Activity Log</h3>
        
        @foreach($signatures as $sig)
            <div style="border-left: 4px solid #223757; background-color: #f9fafb; padding: 14px; margin-bottom: 12px; border-radius: 0 6px 6px 0; border-top: 1px solid #e5e7eb; border-right: 1px solid #e5e7eb; border-bottom: 1px solid #e5e7eb;">
                <table style="width: 100%; font-size: 11px; border-collapse: collapse;">
                    <tr>
                        <td style="width: 20%; font-weight: bold; color: #4b5563; padding: 4px 0;">Signer Role:</td>
                        <td style="color: #223757; font-weight: bold; padding: 4px 0; font-size: 12px;">{{ $sig->signer_role }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; color: #4b5563; padding: 4px 0;">Identifier:</td>
                        <td style="color: #111827; padding: 4px 0;">{{ $sig->signer_identifier }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; color: #4b5563; padding: 4px 0;">IP Address:</td>
                        <td style="color: #111827; padding: 4px 0; font-family: monospace;">{{ $sig->ip_address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; color: #4b5563; padding: 4px 0;">Token ID:</td>
                        <td style="color: #111827; padding: 4px 0; font-family: monospace; font-size: 10px;">{{ $sig->token_id ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; color: #4b5563; padding: 4px 0;">User Agent:</td>
                        <td style="color: #4b5563; padding: 4px 0; font-size: 10px; line-height: 1.3;">{{ $sig->user_agent ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; color: #4b5563; padding: 4px 0;">Signed At:</td>
                        <td style="color: #15803d; font-weight: bold; padding: 4px 0;">{{ $sig->signed_at ? $sig->signed_at->toDayDateTimeString() : 'Pending' }}</td>
                    </tr>
                </table>
            </div>
        @endforeach
    </div>

    <!-- Security/Legal Notice -->
    <div style="border-top: 1px solid #e5e7eb; padding-top: 15px; font-size: 9px; color: #6b7280; text-align: justify; line-height: 1.4;">
        <strong>ESIGN Act & UETA Compliance Statement:</strong> This document carries a legally binding electronic signature. By executing this signature via this digital contract portal, the signing parties acknowledge and agree to conduct transactions electronically in compliance with the Electronic Signatures in Global and National Commerce Act (ESIGN) and the Uniform Electronic Transactions Act (UETA). The cryptographic audit hashes and metadata recorded above provide immutable, secure confirmation of the identities of the signatories and the integrity of the content at the moment of execution.
    </div>
</div>
