<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signature Required</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f3f4f6; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f3f4f6; padding: 40px 0;">
        <tr>
            <td align="center">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); border-top: 6px solid #2563eb;">
                    <!-- Email Header -->
                    <tr>
                        <td style="padding: 40px 40px 20px 40px; text-align: center;">
                            <h1 style="margin: 0; font-size: 24px; font-weight: 700; color: #1e3a8a; letter-spacing: -0.5px;">Signature Required</h1>
                            <p style="margin: 10px 0 0 0; font-size: 14px; color: #4b5563; line-height: 1.5;">You have been requested to electronically sign a document.</p>
                        </td>
                    </tr>
                    
                    <!-- Email Body -->
                    <tr>
                        <td style="padding: 20px 40px 40px 40px;">
                            <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin-bottom: 30px;">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="font-size: 14px; line-height: 1.6;">
                                    <tr>
                                        <td style="font-weight: bold; color: #475569; width: 30%; padding: 4px 0;">Document Name:</td>
                                        <td style="color: #0f172a; padding: 4px 0;">{{ basename($contract->file_path) }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold; color: #475569; padding: 4px 0;">Your Role:</td>
                                        <td style="color: #0f172a; padding: 4px 0;">{{ $signature->signer_role }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold; color: #475569; padding: 4px 0;">Version:</td>
                                        <td style="color: #0f172a; padding: 4px 0;">{{ $contract->version }}</td>
                                    </tr>
                                </table>
                            </div>
                            
                            <p style="font-size: 15px; color: #374151; line-height: 1.6; margin-bottom: 30px;">
                                Please click the secure, cryptographically-signed button below to review and execute this document. This link is unique to you and will expire automatically.
                            </p>
                            
                            <!-- Call to Action Button -->
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center">
                                        <a href="{{ $signedUrl }}" target="_blank" style="display: inline-block; background-color: #2563eb; color: #ffffff; font-weight: 600; font-size: 16px; padding: 14px 32px; text-decoration: none; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2); transition: background-color 0.2s ease;">
                                            Review & Sign Document
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            
                            <p style="font-size: 12px; color: #9ca3af; line-height: 1.5; margin-top: 40px; text-align: center; border-top: 1px solid #e5e7eb; padding-top: 20px;">
                                Security Tip: If you cannot click the button above, copy and paste this URL into your browser:<br>
                                <span style="word-break: break-all; color: #2563eb;">{{ $signedUrl }}</span>
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
