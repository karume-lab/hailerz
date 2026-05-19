<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contract Executed</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f3f4f6; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f3f4f6; padding: 40px 0;">
        <tr>
            <td align="center">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); border-top: 6px solid #16a34a;">
                    <!-- Email Header -->
                    <tr>
                        <td style="padding: 40px 40px 20px 40px; text-align: center;">
                            <h1 style="margin: 0; font-size: 24px; font-weight: 700; color: #14532d; letter-spacing: -0.5px;">Document Fully Executed</h1>
                            <p style="margin: 10px 0 0 0; font-size: 14px; color: #4b5563; line-height: 1.5;">All parties have signed and completed the agreement.</p>
                        </td>
                    </tr>
                    
                    <!-- Email Body -->
                    <tr>
                        <td style="padding: 20px 40px 40px 40px;">
                            <div style="background-color: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 20px; margin-bottom: 30px;">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="font-size: 14px; line-height: 1.6;">
                                    <tr>
                                        <td style="font-weight: bold; color: #166534; width: 30%; padding: 4px 0;">Document:</td>
                                        <td style="color: #14532d; padding: 4px 0;">{{ basename($contract->file_path) }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold; color: #166534; padding: 4px 0;">Status:</td>
                                        <td style="color: #14532d; padding: 4px 0; font-weight: bold;">EXECUTED</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold; color: #166534; padding: 4px 0;">SHA-256 Hash:</td>
                                        <td style="color: #14532d; padding: 4px 0; font-family: monospace; font-size: 11px; word-break: break-all;">{{ $contract->file_hash }}</td>
                                    </tr>
                                </table>
                            </div>
                            
                            <p style="font-size: 15px; color: #374151; line-height: 1.6; margin-bottom: 20px;">
                                We have attached the finalized PDF agreement to this email. It contains the legally binding "Certificate of Completion" audit page appended to the end, documenting all signatories, IP addresses, tokens, and timestamps.
                            </p>
                            
                            <p style="font-size: 15px; color: #374151; line-height: 1.6; margin-bottom: 30px;">
                                Please download and save the attached file for your records. The document hash guarantees that the file has not been altered since execution.
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Email Footer -->
                    <tr>
                        <td style="background-color: #f9fafb; padding: 30px 40px; text-align: center; font-size: 12px; color: #6b7280; border-top: 1px solid #f3f4f6;">
                            &copy; {{ date('Y') }} Hailerz. All rights reserved. &bull; Secure Digital Signature Engine
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
