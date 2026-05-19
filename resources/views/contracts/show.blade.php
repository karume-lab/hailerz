<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review & Sign Contract - {{ config('app.name', 'Hailerz') }}</title>
    <!-- Premium Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --primary-light: rgba(37, 99, 235, 0.1);
            --danger: #dc2626;
            --danger-hover: #b91c1c;
            --success: #16a34a;
            --bg-gradient: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            --card-bg: rgba(255, 255, 255, 0.95);
            --text-main: #0f172a;
            --text-muted: #4b5563;
            --border-color: #e5e7eb;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: #f1f5f9;
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Navigation Header */
        header {
            background: #0f172a;
            color: #ffffff;
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-bottom: 2px solid var(--primary);
        }

        .logo-section h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 0.5px;
            background: linear-gradient(to right, #60a5fa, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .document-badge {
            background: rgba(255, 255, 255, 0.1);
            padding: 6px 12px;
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }

        .status-pending { background: #f59e0b; }
        .status-in_review { background: #3b82f6; }
        .status-executed { background: #10b981; }
        .status-voided { background: #ef4444; }

        /* Main Workspace Layout */
        .workspace {
            display: flex;
            flex: 1;
            padding: 24px;
            gap: 24px;
            max-width: 1600px;
            margin: 0 auto;
            width: 100%;
        }

        @media (max-width: 1024px) {
            .workspace {
                flex-direction: column;
            }
        }

        /* PDF Preview Area */
        .pdf-viewer-container {
            flex: 3;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-height: 600px;
        }

        .pdf-header {
            background: #f8fafc;
            border-bottom: 1px solid var(--border-color);
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pdf-title {
            font-size: 16px;
            font-weight: 600;
            color: #334155;
        }

        .pdf-action-btn {
            background: var(--primary-light);
            color: var(--primary);
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .pdf-action-btn:hover {
            background: var(--primary);
            color: #ffffff;
        }

        .pdf-frame {
            width: 100%;
            flex: 1;
            border: none;
            background: #ebebeb;
        }

        /* Signer Console Sidebar */
        .signer-console {
            flex: 1.5;
            display: flex;
            flex-direction: column;
            gap: 20px;
            min-width: 380px;
        }

        .card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            padding: 24px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .signer-info-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .signer-info-table tr {
            border-bottom: 1px solid #f1f5f9;
        }

        .signer-info-table tr:last-child {
            border-bottom: none;
        }

        .signer-info-table td {
            padding: 10px 0;
        }

        .signer-info-table td.label {
            color: var(--text-muted);
            font-weight: 500;
            width: 35%;
        }

        .signer-info-table td.value {
            color: var(--text-main);
            font-weight: 600;
        }

        /* Interactive signature form */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
        }

        .text-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-family: inherit;
            font-size: 15px;
            transition: border-color 0.2s ease;
        }

        .text-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        /* Simulated Signature Output */
        .signature-preview {
            background: #f8fafc;
            border: 2px dashed #cbd5e1;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .signature-font {
            font-family: 'Space Grotesk', cursive, sans-serif;
            font-size: 24px;
            color: #1e3a8a;
            font-style: italic;
            font-weight: 500;
        }

        /* Checkbox customization */
        .consent-checkbox-container {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            cursor: pointer;
            font-size: 13px;
            line-height: 1.5;
            color: var(--text-muted);
            margin-bottom: 24px;
        }

        .consent-checkbox-container input {
            margin-top: 3px;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 14px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: var(--primary);
            color: #ffffff;
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .btn-primary:disabled {
            background: #cbd5e1;
            color: #94a3b8;
            cursor: not-allowed;
            box-shadow: none;
        }

        .btn-danger {
            background: #fee2e2;
            color: var(--danger);
            border: 1px solid #fca5a5;
        }

        .btn-danger:hover {
            background: var(--danger);
            color: #ffffff;
        }

        /* Status Alert Banners */
        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.5;
        }

        .alert-success {
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .alert-info {
            background: #e0f2fe;
            border: 1px solid #bae6fd;
            color: #0369a1;
        }

        .alert-danger {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #c2410c;
        }

        /* Toggle Actions */
        .toggle-section {
            display: none;
            margin-top: 15px;
            border-top: 1px solid var(--border-color);
            padding-top: 15px;
        }
    </style>
</head>
<body>

    <!-- Header Navigation -->
    <header>
        <div class="logo-section">
            <h1>{{ config('app.name', 'Hailerz') }} Sign</h1>
        </div>
        <div class="document-badge">
            <span class="status-dot status-{{ $contract->status }}"></span>
            Contract {{ strtoupper($contract->status) }} &bull; Version {{ $contract->version }}
        </div>
    </header>

    <!-- Main Workspace -->
    <div class="workspace">
        
        <!-- Left Side: Interactive Document View -->
        <div class="pdf-viewer-container">
            <div class="pdf-header">
                <span class="pdf-title">{{ basename($contract->file_path) }}</span>
                <a href="{{ URL::signedRoute('contracts.download', ['contract' => $contract->id]) }}" class="pdf-action-btn" target="_blank">
                    Download Original PDF
                </a>
            </div>
            
            <!-- Render Contract PDF locally inside iframe -->
            <iframe src="{{ URL::signedRoute('contracts.download', ['contract' => $contract->id]) }}#toolbar=0" class="pdf-frame">
                This browser does not support PDF embedding. Please click the button above to download and review.
            </iframe>
        </div>

        <!-- Right Side: Action Console -->
        <div class="signer-console">
            
            <!-- Flash Message Alerts -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info">
                    {{ session('info') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul style="list-style-type: none;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Signer Identity Card -->
            <div class="card">
                <div class="card-title">
                    Reviewer Details
                </div>
                <table class="signer-info-table">
                    <tr>
                        <td class="label">Your Role</td>
                        <td class="value">{{ $signature->signer_role }}</td>
                    </tr>
                    <tr>
                        <td class="label">Identifier</td>
                        <td class="value">{{ $signature->signer_identifier }}</td>
                    </tr>
                    <tr>
                        <td class="label">Token Status</td>
                        <td class="value">
                            @if($signature->signed_at)
                                <span style="color: var(--success); font-weight: bold;">SIGNED</span>
                            @else
                                <span style="color: #f59e0b; font-weight: bold;">UNSIGNED</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Signature Card -->
            @if(! $signature->signed_at && ! in_array($contract->status, ['executed', 'voided']))
                <div class="card">
                    <div class="card-title">
                        Execute Digital Signature
                    </div>
                    
                    <form action="{{ request()->fullUrl() }}" method="POST" id="signature-form">
                        @csrf
                        
                        <div class="form-group">
                            <label class="form-label" for="signer_name">Type Full Name to Sign</label>
                            <input type="text" id="signer_name" name="signer_name" class="text-input" placeholder="e.g. Johnathan Doe" required autocomplete="off">
                        </div>

                        <!-- Simulated Handwritten Signature -->
                        <div class="form-group">
                            <label class="form-label">Digital Signature Style</label>
                            <div class="signature-preview">
                                <span id="signature-preview-text" class="signature-font">Your Signature</span>
                            </div>
                        </div>

                        <!-- ESIGN Consent Checkbox -->
                        <label class="consent-checkbox-container">
                            <input type="checkbox" name="esign_consent" value="1" required id="esign_consent">
                            <span>I consent to electronically sign this document. I acknowledge that my typed signature above constitutes a legally binding execution under ESIGN & UETA rules.</span>
                        </label>

                        <button type="submit" class="btn btn-primary" id="submit-signature-btn" disabled>
                            Submit Legally Binding Signature
                        </button>
                    </form>

                    <!-- Toggle Request Revision Link -->
                    <div style="text-align: center; margin-top: 20px;">
                        <a href="#" style="color: var(--danger); font-size: 14px; font-weight: 600; text-decoration: none;" id="toggle-revision-btn">
                            Need changes? Request a revision
                        </a>
                    </div>

                    <!-- Hidden Revision Form -->
                    <div class="toggle-section" id="revision-form-container">
                        <form action="{{ URL::signedRoute('contracts.revision', ['contract' => $contract->id, 'role' => $role, 'email' => $email]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="revision_notes">Revision Notes & Reason for Rejection</label>
                                <textarea id="revision_notes" name="revision_notes" class="text-input" rows="4" style="resize: none;" placeholder="Explain what changes are needed to proceed..." required minlength="10"></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger">
                                Reject & Request Revision
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="card" style="text-align: center; padding: 40px 24px;">
                    <div style="color: var(--success); font-size: 48px; margin-bottom: 16px;">✓</div>
                    <h3 style="margin-bottom: 10px;">Execution Locked</h3>
                    <p style="color: var(--text-muted); font-size: 14px; line-height: 1.6;">
                        This signature session is complete. The contract is either fully signed, voided, or you have already recorded your signature for this version.
                    </p>
                </div>
            @endif

        </div>
    </div>

    <!-- Client-side Interactive Logic -->
    <script>
        const nameInput = document.getElementById('signer_name');
        const previewText = document.getElementById('signature-preview-text');
        const consentCheckbox = document.getElementById('esign_consent');
        const submitBtn = document.getElementById('submit-signature-btn');
        const toggleRevisionBtn = document.getElementById('toggle-revision-btn');
        const revisionForm = document.getElementById('revision-form-container');

        if (nameInput) {
            // Live typing signature feedback
            nameInput.addEventListener('input', (e) => {
                const name = e.target.value.trim();
                previewText.textContent = name ? name : 'Your Signature';
            });
        }

        if (consentCheckbox && submitBtn) {
            // Require consent checkbox to enable signing button
            consentCheckbox.addEventListener('change', (e) => {
                submitBtn.disabled = !e.target.checked;
            });
        }

        if (toggleRevisionBtn && revisionForm) {
            // Toggle revision notes display
            toggleRevisionBtn.addEventListener('click', (e) => {
                e.preventDefault();
                if (revisionForm.style.display === 'block') {
                    revisionForm.style.display = 'none';
                    toggleRevisionBtn.textContent = 'Need changes? Request a revision';
                } else {
                    revisionForm.style.display = 'block';
                    toggleRevisionBtn.textContent = 'Cancel revision request';
                }
            });
        }
    </script>
</body>
</html>
