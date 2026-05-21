<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template Previews | Hailerz</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fcfcfc;
        }
        .hero-title {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="h-full flex flex-col antialiased text-text-primary overflow-hidden">
    <!-- Navbar -->
    <nav class="bg-white border-b border-subtle h-16 flex items-center justify-between px-6 shrink-0 z-10">
        <div class="flex items-center gap-3">
            <a href="/previews" class="flex items-center gap-2 text-text-secondary hover:text-brand-primary transition-colors group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="text-sm font-semibold">Back to Hub</span>
            </a>
            <div class="h-4 w-px bg-subtle mx-2"></div>
            <span class="font-bold text-lg hero-title text-brand-accent">Email Template Previews</span>
        </div>
        <div class="flex items-center gap-4">
            <a id="open-new-tab-btn" href="#" target="_blank" class="hidden text-xs bg-brand-secondary/10 text-brand-secondary hover:bg-brand-secondary hover:text-white font-bold py-2 px-4 rounded-xl transition-all duration-300 items-center gap-1.5 shadow-sm">
                Open in New Tab
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
            </a>
        </div>
    </nav>

    <!-- Main Workspace -->
    <div class="flex flex-1 overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-80 bg-white border-r border-subtle flex flex-col shrink-0 overflow-y-auto">
            <!-- Group: Outbound User Emails -->
            <div class="p-4 border-b border-subtle bg-surface-muted/50">
                <span class="text-xs font-bold text-text-muted uppercase tracking-wider">User Transactional Emails</span>
            </div>
            <div class="p-2 flex flex-col gap-1">
                <!-- Booking Confirmation -->
                <button onclick="selectTemplate('booking-confirmation')" id="btn-booking-confirmation" class="w-full text-left px-4 py-3 rounded-xl border border-transparent hover:bg-surface-muted/80 transition-all duration-150 group flex items-center gap-3">
                    <div class="w-2.5 h-2.5 rounded-full bg-brand-primary/40 group-hover:bg-brand-primary transition-colors"></div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-xs text-text-primary group-hover:text-brand-primary">Booking Confirmation</h4>
                        <span class="text-[10px] text-text-muted">Inquiry receipt summary</span>
                    </div>
                </button>

                <!-- Talent Agreement -->
                <button onclick="selectTemplate('talent-agreement')" id="btn-talent-agreement" class="w-full text-left px-4 py-3 rounded-xl border border-transparent hover:bg-surface-muted/80 transition-all duration-150 group flex items-center gap-3">
                    <div class="w-2.5 h-2.5 rounded-full bg-brand-primary/40 group-hover:bg-brand-primary transition-colors"></div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-xs text-text-primary group-hover:text-brand-primary">Representation Offer</h4>
                        <span class="text-[10px] text-text-muted">Talent agreement invitation</span>
                    </div>
                </button>

                <!-- Signature Request -->
                <button onclick="selectTemplate('contract-signature-request')" id="btn-contract-signature-request" class="w-full text-left px-4 py-3 rounded-xl border border-transparent hover:bg-surface-muted/80 transition-all duration-150 group flex items-center gap-3">
                    <div class="w-2.5 h-2.5 rounded-full bg-brand-primary/40 group-hover:bg-brand-primary transition-colors"></div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-xs text-text-primary group-hover:text-brand-primary">Signature Required</h4>
                        <span class="text-[10px] text-text-muted">Contract signature link request</span>
                    </div>
                </button>

                <!-- Contract Signed -->
                <button onclick="selectTemplate('contract-signed')" id="btn-contract-signed" class="w-full text-left px-4 py-3 rounded-xl border border-transparent hover:bg-surface-muted/80 transition-all duration-150 group flex items-center gap-3">
                    <div class="w-2.5 h-2.5 rounded-full bg-brand-primary/40 group-hover:bg-brand-primary transition-colors"></div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-xs text-text-primary group-hover:text-brand-primary">Contract Executed</h4>
                        <span class="text-[10px] text-text-muted">Agreement fully signed summary</span>
                    </div>
                </button>

                <!-- Talent Frozen -->
                <button onclick="selectTemplate('talent-frozen')" id="btn-talent-frozen" class="w-full text-left px-4 py-3 rounded-xl border border-transparent hover:bg-surface-muted/80 transition-all duration-150 group flex items-center gap-3">
                    <div class="w-2.5 h-2.5 rounded-full bg-brand-primary/40 group-hover:bg-brand-primary transition-colors"></div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-xs text-text-primary group-hover:text-brand-primary">Profile Frozen</h4>
                        <span class="text-[10px] text-text-muted">Account suspension notice</span>
                    </div>
                </button>

                <!-- Talent Submission -->
                <button onclick="selectTemplate('talent-submission')" id="btn-talent-submission" class="w-full text-left px-4 py-3 rounded-xl border border-transparent hover:bg-surface-muted/80 transition-all duration-150 group flex items-center gap-3">
                    <div class="w-2.5 h-2.5 rounded-full bg-brand-primary/40 group-hover:bg-brand-primary transition-colors"></div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-xs text-text-primary group-hover:text-brand-primary">Submission Received</h4>
                        <span class="text-[10px] text-text-muted">Artist applicant receipt confirmation</span>
                    </div>
                </button>
            </div>

            <!-- Group: Admin Notifications -->
            <div class="p-4 border-t border-b border-subtle bg-surface-muted/50 mt-2">
                <span class="text-xs font-bold text-text-muted uppercase tracking-wider">Admin Notification Alerts</span>
            </div>
            <div class="p-2 flex flex-col gap-1">
                <!-- Admin Booking Notification -->
                <button onclick="selectTemplate('admin-booking-notification')" id="btn-admin-booking-notification" class="w-full text-left px-4 py-3 rounded-xl border border-transparent hover:bg-surface-muted/80 transition-all duration-150 group flex items-center gap-3">
                    <div class="w-2.5 h-2.5 rounded-full bg-brand-secondary/40 group-hover:bg-brand-secondary transition-colors"></div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-xs text-text-primary group-hover:text-brand-secondary">Booking Request Alert</h4>
                        <span class="text-[10px] text-text-muted">New booking details alert</span>
                    </div>
                </button>

                <!-- Admin Staffing Inquiry Notification -->
                <button onclick="selectTemplate('admin-staffing-inquiry-notification')" id="btn-admin-staffing-inquiry-notification" class="w-full text-left px-4 py-3 rounded-xl border border-transparent hover:bg-surface-muted/80 transition-all duration-150 group flex items-center gap-3">
                    <div class="w-2.5 h-2.5 rounded-full bg-brand-secondary/40 group-hover:bg-brand-secondary transition-colors"></div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-xs text-text-primary group-hover:text-brand-secondary">Staffing Request Alert</h4>
                        <span class="text-[10px] text-text-muted">New staffing inquiry alert</span>
                    </div>
                </button>

                <!-- Admin Talent Submission Notification -->
                <button onclick="selectTemplate('admin-talent-submission-notification')" id="btn-admin-talent-submission-notification" class="w-full text-left px-4 py-3 rounded-xl border border-transparent hover:bg-surface-muted/80 transition-all duration-150 group flex items-center gap-3">
                    <div class="w-2.5 h-2.5 rounded-full bg-brand-secondary/40 group-hover:bg-brand-secondary transition-colors"></div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-xs text-text-primary group-hover:text-brand-secondary">Talent Application Alert</h4>
                        <span class="text-[10px] text-text-muted">New applicant registration alert</span>
                    </div>
                </button>

                <!-- Staffing Inquiry Reply -->
                <button onclick="selectTemplate('staffing-inquiry-reply')" id="btn-staffing-inquiry-reply" class="w-full text-left px-4 py-3 rounded-xl border border-transparent hover:bg-surface-muted/80 transition-all duration-150 group flex items-center gap-3">
                    <div class="w-2.5 h-2.5 rounded-full bg-brand-secondary/40 group-hover:bg-brand-secondary transition-colors"></div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-xs text-text-primary group-hover:text-brand-secondary">Staffing Inquiry Reply</h4>
                        <span class="text-[10px] text-text-muted">Direct email reply to staffing need</span>
                    </div>
                </button>
            </div>
        </aside>

        <!-- Preview Pane -->
        <main class="flex-1 bg-surface-muted flex flex-col relative overflow-hidden">
            <!-- Loading Indicator -->
            <div id="loader" class="hidden absolute inset-0 bg-white/80 backdrop-blur-sm z-20 items-center justify-center">
                <div class="flex flex-col items-center gap-3">
                    <div class="w-10 h-10 border-4 border-brand-secondary border-t-transparent rounded-full animate-spin"></div>
                    <span class="text-xs font-semibold text-text-secondary">Compiling Email Template...</span>
                </div>
            </div>

            <!-- Empty State -->
            <div id="empty-state" class="absolute inset-0 flex flex-col items-center justify-center p-12 text-center">
                <div class="w-20 h-20 rounded-2xl bg-white border border-subtle flex items-center justify-center text-text-muted shadow-sm mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="hero-title text-xl font-bold text-brand-accent mb-2">No Email Selected</h3>
                <p class="text-sm text-text-secondary max-w-sm leading-relaxed mb-6">
                    Select any transactional or admin notification template from the sidebar to inspect its styling and components.
                </p>
            </div>

            <!-- Iframe Container -->
            <iframe id="preview-iframe" class="hidden w-full h-full border-none z-10" src=""></iframe>
        </main>
    </div>

    <!-- Script for Live Interaction -->
    <script>
        function selectTemplate(template) {
            // Show Loader and Iframe
            const iframe = document.getElementById('preview-iframe');
            const emptyState = document.getElementById('empty-state');
            const loader = document.getElementById('loader');
            const newTabBtn = document.getElementById('open-new-tab-btn');

            loader.classList.remove('hidden');
            loader.classList.add('flex');
            iframe.classList.remove('hidden');
            emptyState.classList.add('hidden');
            newTabBtn.classList.remove('hidden');
            newTabBtn.classList.add('inline-flex');

            // Update Iframe URL & new tab link
            const url = `/previews/emails/view/${template}`;
            iframe.src = url;
            newTabBtn.href = url;

            // Handle Active States in Sidebar
            const buttons = document.querySelectorAll('aside button');
            buttons.forEach(btn => {
                btn.classList.remove('bg-brand-primary/5', 'border-brand-primary/20', 'bg-brand-secondary/5', 'border-brand-secondary/20', 'shadow-sm');
                btn.classList.add('border-transparent');
            });

            const activeBtn = document.getElementById(`btn-${template}`);
            if (activeBtn) {
                activeBtn.classList.remove('border-transparent');
                // Color accent depending on if it's admin or user email
                if (template.startsWith('admin') || template === 'staffing-inquiry-reply') {
                    activeBtn.classList.add('bg-brand-secondary/5', 'border-brand-secondary/20', 'shadow-sm');
                } else {
                    activeBtn.classList.add('bg-brand-primary/5', 'border-brand-primary/20', 'shadow-sm');
                }
            }

            // Hide loader when iframe finishes rendering
            iframe.onload = function() {
                loader.classList.add('hidden');
                loader.classList.remove('flex');
            };
        }
    </script>
</body>
</html>
