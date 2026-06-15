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
                        <x-lucide-file-text class="h-5 w-5 text-brand-primary shrink-0" />
                        <span class="text-sm font-semibold text-text-primary truncate">
                            {{ basename($contract->file_path) }}
                        </span>
                    </div>

                    <a href="{{ URL::signedRoute('contracts.download', ['contract' => $contract->id]) }}"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-brand-primary hover:text-brand-secondary bg-brand-primary/5 hover:bg-brand-primary/10 rounded-lg transition-all"
                        target="_blank">
                        <x-lucide-download class="h-4 w-4" stroke-width="2.5" />
                        Download PDF
                    </a>
                </div>

                <!-- PDF Renderer frame -->
                <div
                    class="relative grow min-h-150 lg:min-h-187.5 bg-neutral-100 dark:bg-neutral-900 flex flex-col overflow-y-auto px-2 sm:px-4 py-4" id="pdf-container">
                    
                    <!-- Loading Indicator -->
                    <div id="pdf-loading" class="absolute inset-0 flex flex-col items-center justify-center bg-neutral-100 dark:bg-neutral-900 z-10">
                        <x-lucide-loader-2 class="h-8 w-8 text-brand-primary animate-spin mb-3" />
                        <span class="text-sm font-medium text-text-muted">Loading document for review...</span>
                    </div>

                    <!-- Error State (Hidden by default) -->
                    <div id="pdf-error" class="absolute inset-0 flex-col items-center justify-center bg-neutral-100 dark:bg-neutral-900 z-10 hidden px-6 text-center">
                        <x-lucide-alert-circle class="h-10 w-10 text-rose-500 mb-3" />
                        <h3 class="text-base font-bold text-text-primary mb-1">Document Preview Unavailable</h3>
                        <p class="text-sm text-text-muted mb-4 max-w-md">We couldn't load the interactive preview. This typically happens on certain mobile browsers or if you have strict privacy settings.</p>
                        <a href="{{ URL::signedRoute('contracts.download', ['contract' => $contract->id]) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-brand-primary rounded-xl"
                            target="_blank">
                            <x-lucide-download class="h-4 w-4" stroke-width="2.5" />
                            Download PDF Instead
                        </a>
                    </div>
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
                            <span class="font-semibold text-text-primary truncate max-w-50"
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
                @if(!$signature->signed_at && !in_array($contract->status, ['signed', 'voided']))
                    <div
                        class="bg-surface-light border border-subtle rounded-2xl p-6 shadow-sm transition-colors duration-300 flex flex-col gap-6">
                        <div class="border-b border-subtle pb-4">
                            <h3 class="text-lg font-bold text-text-primary">
                                Sign Agreement
                            </h3>
                            <p class="text-xs text-text-muted mt-1 leading-relaxed">
                                Review the document on the left carefully. When ready, complete the electronic signature
                                fields below.
                            </p>
                        </div>

                        <form action="{{ request()->fullUrl() }}" method="POST" id="signature-form" class="space-y-6">
                            @csrf

                            <!-- Signer Name Input -->
                            <x-input
                                name="signer_name"
                                label="Type Full Name *"
                                placeholder="e.g. Johnathan Doe"
                                required
                                autocomplete="off"
                                value="{{ old('signer_name') }}"
                            />

                            <!-- Interactive Handwriting Preview -->
                            <div class="space-y-3">
                                <span class="block text-[10px] font-bold text-text-muted uppercase tracking-widest">
                                    Signature Style Preview
                                </span>
                                <div
                                    class="bg-surface-muted border border-dashed border-subtle rounded-4xl p-6 flex items-center justify-center min-h-25 transition-colors duration-300">
                                    <span id="signature-preview-text"
                                        class="font-['Alex_Brush',cursive] text-4xl text-neutral-800 dark:text-neutral-200 select-none tracking-wide">
                                        Your Signature
                                    </span>
                                </div>
                            </div>

                            <!-- Legal Consent -->
                            <div class="relative flex items-start p-6 bg-brand-primary/5 rounded-4xl border border-brand-primary/10 transition-colors duration-300">
                                <div class="flex h-6 items-center">
                                    <input type="checkbox" name="esign_consent" value="1" required id="esign_consent"
                                        class="h-4 w-4 rounded border-brand-primary/30 text-brand-primary focus:ring-brand-primary">
                                </div>
                                <div class="ml-4 text-xs leading-5">
                                    <label for="esign_consent" class="font-bold text-text-primary block mb-1">ESIGN Act Consent *</label>
                                    <p class="text-text-secondary leading-relaxed">I consent to electronically sign this document and understand that my typed name represents a legally binding digital signature.</p>
                                    @error('esign_consent')
                                        <span class="text-red-500 text-[11px] font-bold mt-2 block tracking-tight">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- CTA Submit -->
                            <x-button type="submit" variant="primary" size="md" class="w-full py-4" id="submit-signature-btn" disabled>
                                Sign Document
                            </x-button>
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
                                method="POST" class="space-y-5">
                                @csrf
                                <x-textarea
                                    name="revision_notes"
                                    label="Revision Details & Feedback *"
                                    placeholder="Describe the corrections needed on this agreement..."
                                    required
                                    minlength="10"
                                    rows="4"
                                />
                                <x-button type="submit" variant="accent" size="md" class="w-full">
                                    Submit Review Feedback
                                </x-button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Locked/Signed Card -->
                    <div
                        class="bg-surface-light border border-subtle rounded-2xl p-8 shadow-sm transition-colors duration-300 text-center flex flex-col items-center gap-4 animate-fadeIn">
                        <div
                            class="h-16 w-16 bg-emerald-500/15 text-emerald-500 rounded-full flex items-center justify-center">
                            <x-lucide-shield-check class="h-8 w-8" stroke-width="2.5" />
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-text-primary">
                                Signing Complete
                            </h3>
                            <p class="text-sm text-text-muted mt-2 leading-relaxed mb-6">
                                This digital signature session has concluded. The agreement is locked and safely recorded in
                                our database.
                            </p>
                            <a href="{{ URL::signedRoute('contracts.download', ['contract' => $contract->id]) }}"
                                class="inline-flex items-center justify-center gap-2 w-full px-5 py-3 text-sm font-semibold text-white bg-brand-primary hover:bg-brand-primary/95 rounded-xl shadow-md hover:shadow-lg transition-all"
                                target="_blank">
                                <x-lucide-download class="h-4 w-4" stroke-width="2.5" />
                                Download Signed Copy (PDF)
                            </a>
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

    <!-- PDF.js library for reliable rendering across all devices (especially iOS/Mobile) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof pdfjsLib === 'undefined') {
                document.getElementById('pdf-loading').classList.add('hidden');
                document.getElementById('pdf-error').classList.remove('hidden');
                document.getElementById('pdf-error').style.display = 'flex';
                return;
            }

            pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

            const url = "{{ URL::signedRoute('contracts.download', ['contract' => $contract->id]) }}";
            const container = document.getElementById('pdf-container');
            const loading = document.getElementById('pdf-loading');
            const error = document.getElementById('pdf-error');

            const loadingTask = pdfjsLib.getDocument(url);
            loadingTask.promise.then(function(pdf) {
                loading.classList.add('hidden');
                
                // Render pages sequentially
                let renderPage = function(pageNum) {
                    if (pageNum > pdf.numPages) return;
                    
                    const canvasWrapper = document.createElement('div');
                    canvasWrapper.className = 'w-full flex justify-center mb-6';
                    
                    const canvas = document.createElement('canvas');
                    canvas.className = 'max-w-full shadow-md bg-white border border-subtle/30 rounded-sm';
                    
                    canvasWrapper.appendChild(canvas);
                    container.appendChild(canvasWrapper);

                    pdf.getPage(pageNum).then(function(page) {
                        // Dynamically scale based on container width
                        const containerWidth = container.clientWidth - 32; // Account for padding
                        let unscaledViewport = page.getViewport({ scale: 1.0 });
                        
                        // Default to 1.5 for crispness, but scale down if it exceeds container width
                        let scale = 1.5;
                        if ((unscaledViewport.width * scale) > containerWidth) {
                            scale = containerWidth / unscaledViewport.width;
                        }

                        const viewport = page.getViewport({scale: scale});
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;

                        const renderContext = {
                            canvasContext: canvas.getContext('2d'),
                            viewport: viewport
                        };
                        
                        page.render(renderContext).promise.then(function() {
                            // Proceed to render next page once current is done
                            renderPage(pageNum + 1);
                        });
                    });
                };

                renderPage(1);

            }, function (reason) {
                console.error('PDF loading error: ', reason);
                loading.classList.add('hidden');
                error.classList.remove('hidden');
                error.style.display = 'flex';
            });
        });
    </script>
</body>

</html>