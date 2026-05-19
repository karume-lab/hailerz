<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review & Sign Contract - {{ config('app.name', 'Hailerz') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Vite Assets (App Styles & JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        function applyTheme() {
            if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
        applyTheme();
    </script>
</head>

<body class="bg-surface-muted text-text-primary antialiased min-h-screen flex flex-col transition-colors duration-300">

    <!-- Top Navigation Header -->
    <header
        class="sticky top-0 z-50 backdrop-blur-xl bg-surface-light/80 border-b border-subtle transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="shrink-0 flex items-center gap-3">
                    <a href="/" class="flex items-center gap-2.5" aria-label="Hailerz Home">
                        <img src="{{ asset('images/logo.webp') }}" alt="Hailerz Logo"
                            class="h-8 w-auto object-contain rounded" />
                        <span class="text-xl sm:text-2xl font-semibold tracking-tight text-brand-primary">
                            Hailerz
                        </span>
                    </a>
                    <span class="h-5 w-px bg-subtle"></span>
                    <span
                        class="text-xs font-semibold tracking-widest text-text-muted uppercase bg-brand-primary/10 text-brand-primary px-2.5 py-1 rounded-full">
                        Sign
                    </span>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Workspace -->
    <main class="grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left Side: Interactive Document View -->
            <div
                class="lg:col-span-2 flex flex-col bg-surface-light border border-subtle rounded-2xl overflow-hidden shadow-sm transition-colors duration-300">
                <div class="flex justify-between items-center px-6 py-4 bg-surface-muted/50 border-b border-subtle">
                    <div class="flex items-center gap-3 min-w-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-brand-primary shrink-0" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="text-sm font-semibold text-text-primary truncate">
                            {{ basename($contract->file_path) }}
                        </span>
                    </div>

                    <a href="{{ URL::signedRoute('contracts.download', ['contract' => $contract->id]) }}"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-brand-primary hover:text-brand-secondary bg-brand-primary/5 hover:bg-brand-primary/10 rounded-lg transition-all"
                        target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Download PDF
                    </a>
                </div>

                <!-- PDF Renderer frame -->
                <div
                    class="relative grow min-h-[600px] lg:min-h-[750px] bg-neutral-100 dark:bg-neutral-900 flex flex-col">
                    <iframe src="{{ URL::signedRoute('contracts.download', ['contract' => $contract->id]) }}#toolbar=0"
                        class="absolute inset-0 w-full h-full border-none">
                        This browser does not support PDF embedding. Please click the button above to download and
                        review.
                    </iframe>
                </div>
            </div>

            <!-- Right Side: Action Console -->
            <div class="flex flex-col gap-6">

                <!-- Status Alerts -->
                @if(session('success'))
                    <div
                        class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 rounded-xl text-sm font-medium animate-fadeIn">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('info'))
                    <div
                        class="p-4 bg-brand-primary/10 border border-brand-primary/20 text-brand-primary rounded-xl text-sm font-medium animate-fadeIn">
                        {{ session('info') }}
                    </div>
                @endif

                @if($errors->any())
                    <div
                        class="p-4 bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 rounded-xl text-sm font-medium animate-fadeIn">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Card: Reviewer Details -->
                <div
                    class="bg-surface-light border border-subtle rounded-2xl p-6 shadow-sm transition-colors duration-300">
                    <h3 class="font-bold mb-4 uppercase tracking-wider text-xs text-brand-primary">
                        Recipient Details
                    </h3>
                    <div class="space-y-4 text-sm">
                        <div class="flex justify-between py-2 border-b border-subtle/50">
                            <span class="text-text-muted">Your Role</span>
                            <span
                                class="font-semibold text-text-primary capitalize">{{ $signature->signer_role }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-subtle/50">
                            <span class="text-text-muted">Email</span>
                            <span class="font-semibold text-text-primary truncate max-w-[200px]"
                                title="{{ $signature->signer_identifier }}">
                                {{ $signature->signer_identifier }}
                            </span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-text-muted">Status</span>
                            <span
                                class="inline-flex items-center gap-1.5 font-bold">
                                {{ $signature->signed_at ? 'Completed' : 'Awaiting Signature' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Card: Signature Interaction -->
                @if(!$signature->signed_at && !in_array($contract->status, ['executed', 'voided']))
                    <div
                        class="bg-surface-light border border-subtle rounded-2xl p-6 shadow-sm transition-colors duration-300 flex flex-col gap-6">
                        <div class="border-b border-subtle pb-4">
                            <h3 class="text-lg font-bold text-text-primary">
                                Execute Agreement
                            </h3>
                            <p class="text-xs text-text-muted mt-1 leading-relaxed">
                                Review the document on the left carefully. When ready, complete the electronic signature
                                fields below.
                            </p>
                        </div>

                        <form action="{{ request()->fullUrl() }}" method="POST" id="signature-form" class="space-y-5">
                            @csrf

                            <!-- Signer Name Input -->
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-text-secondary" for="signer_name">
                                    Type Full Name
                                </label>
                                <input type="text" id="signer_name" name="signer_name"
                                    class="w-full px-4 py-3 bg-surface-muted border border-subtle rounded-xl text-text-primary focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary focus:outline-none transition-all"
                                    placeholder="e.g. Johnathan Doe" required autocomplete="off">
                            </div>

                            <!-- Interactive Handwriting Preview -->
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-text-muted uppercase tracking-wider">
                                    Signature Style Preview
                                </label>
                                <div
                                    class="bg-surface-muted border border-dashed border-subtle rounded-xl p-5 flex items-center justify-center min-h-[90px] transition-colors duration-300">
                                    <span id="signature-preview-text"
                                        class="font-['Alex_Brush',cursive] text-4xl text-neutral-800 dark:text-neutral-200 select-none tracking-wide">
                                        Your Signature
                                    </span>
                                </div>
                            </div>

                            <!-- Legal Consent -->
                            <label
                                class="flex items-start gap-3 cursor-pointer text-xs leading-relaxed text-text-secondary select-none">
                                <input type="checkbox" name="esign_consent" value="1" required id="esign_consent"
                                    class="mt-0.5 rounded border-subtle text-brand-primary focus:ring-brand-primary">
                                <span>I consent to electronically sign this document and understand that my typed name above
                                    represents a legally binding digital execution.</span>
                            </label>

                            <!-- CTA Submit -->
                            <button type="submit"
                                class="w-full inline-flex justify-center items-center gap-2 px-6 py-4 bg-brand-primary hover:bg-brand-secondary disabled:bg-neutral-200 disabled:dark:bg-neutral-800 disabled:text-text-muted text-text-inverse font-semibold rounded-xl hover:scale-[1.01] active:scale-[0.99] transition-all shadow-sm shadow-brand-primary/10 cursor-pointer disabled:pointer-events-none"
                                id="submit-signature-btn" disabled>
                                Sign Document
                            </button>
                        </form>

                        <!-- Revision Request Toggle -->
                        <div class="text-center pt-2">
                            <button type="button"
                                class="text-xs font-semibold text-brand-secondary hover:text-brand-secondary/80 transition-colors"
                                id="toggle-revision-btn">
                                Request a revision instead
                            </button>
                        </div>

                        <!-- Smooth Slide-Down Revision Form (Hidden by default) -->
                        <div class="hidden border-t border-subtle pt-6 animate-fadeIn" id="revision-form-container">
                            <form
                                action="{{ URL::signedRoute('contracts.revision', ['contract' => $contract->id, 'role' => $role, 'email' => $email]) }}"
                                method="POST" class="space-y-4">
                                @csrf
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-text-secondary" for="revision_notes">
                                        Revision Details & Feedback
                                    </label>
                                    <textarea id="revision_notes" name="revision_notes"
                                        class="w-full px-4 py-3 bg-surface-muted border border-subtle rounded-xl text-text-primary focus:ring-2 focus:ring-brand-secondary/20 focus:border-brand-secondary focus:outline-none transition-all resize-none text-sm"
                                        rows="4" placeholder="Describe the corrections needed on this agreement..." required
                                        minlength="10"></textarea>
                                </div>
                                <button type="submit"
                                    class="w-full inline-flex justify-center items-center gap-2 px-6 py-3 bg-brand-secondary hover:bg-brand-secondary/90 text-text-inverse font-semibold rounded-xl transition-all shadow-sm shadow-brand-secondary/10 cursor-pointer">
                                    Submit Review Feedback
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Locked/Signed Card -->
                    <div
                        class="bg-surface-light border border-subtle rounded-2xl p-8 shadow-sm transition-colors duration-300 text-center flex flex-col items-center gap-4">
                        <div
                            class="h-16 w-16 bg-emerald-500/15 text-emerald-500 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-text-primary">
                                Execution Complete
                            </h3>
                            <p class="text-sm text-text-muted mt-2 leading-relaxed">
                                This digital signature session has concluded. The agreement is locked and safely recorded in
                                our database.
                            </p>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </main>

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
            // Toggle revision notes display using Tailwind hidden class
            toggleRevisionBtn.addEventListener('click', (e) => {
                e.preventDefault();
                const isHidden = revisionForm.classList.contains('hidden');
                if (isHidden) {
                    revisionForm.classList.remove('hidden');
                    toggleRevisionBtn.textContent = 'Cancel revision request';
                } else {
                    revisionForm.classList.add('hidden');
                    toggleRevisionBtn.textContent = 'Request a revision instead';
                }
            });
        }
    </script>
</body>

</html>