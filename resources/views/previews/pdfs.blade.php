<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Document Previews | Hailerz</title>
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
            <span class="font-bold text-lg hero-title text-brand-accent">PDF Document Previews</span>
        </div>
        <div class="flex items-center gap-4">
            <a id="open-new-tab-btn" href="#" target="_blank" class="hidden text-xs bg-brand-primary/10 text-brand-primary hover:bg-brand-primary hover:text-white font-bold py-2 px-4 rounded-xl transition-all duration-300 items-center gap-1.5 shadow-sm">
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
            <div class="p-4 border-b border-subtle bg-surface-muted/50">
                <span class="text-xs font-bold text-text-muted uppercase tracking-wider">PDF Templates</span>
            </div>
            <div class="p-3 flex flex-col gap-2">
                <!-- Talent Agreement Button -->
                <button onclick="selectTemplate('talent-representation-agreement')" id="btn-talent-representation-agreement" class="w-full text-left p-4 rounded-2xl border border-transparent hover:bg-surface-muted/80 transition-all duration-200 group relative">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-9 h-9 rounded-xl bg-brand-primary/10 text-brand-primary flex items-center justify-center group-hover:bg-brand-primary group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-sm text-text-primary group-hover:text-brand-primary transition-colors">Talent Agreement</h3>
                    </div>
                    <p class="text-xs text-text-secondary leading-relaxed pl-12">
                        Representation agreement contract featuring appended completion certificate with dynamic logs.
                    </p>
                </button>

                <!-- Booking Inquiry Button -->
                <button onclick="selectTemplate('booking-inquiry')" id="btn-booking-inquiry" class="w-full text-left p-4 rounded-2xl border border-transparent hover:bg-surface-muted/80 transition-all duration-200 group relative">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-9 h-9 rounded-xl bg-brand-primary/10 text-brand-primary flex items-center justify-center group-hover:bg-brand-primary group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-sm text-text-primary group-hover:text-brand-primary transition-colors">Booking Inquiry</h3>
                    </div>
                    <p class="text-xs text-text-secondary leading-relaxed pl-12">
                        Full event schedule, budget range, preferred talent, and organizer details PDF ledger.
                    </p>
                </button>

                <!-- Talent Submission Button -->
                <button onclick="selectTemplate('talent-submission')" id="btn-talent-submission" class="w-full text-left p-4 rounded-2xl border border-transparent hover:bg-surface-muted/80 transition-all duration-200 group relative">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-9 h-9 rounded-xl bg-brand-primary/10 text-brand-primary flex items-center justify-center group-hover:bg-brand-primary group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-sm text-text-primary group-hover:text-brand-primary transition-colors">Talent Dossier</h3>
                    </div>
                    <p class="text-xs text-text-secondary leading-relaxed pl-12">
                        Comprehensive artist profile, rate ranges, bios, handles, and gallery compilation.
                    </p>
                </button>
            </div>
        </aside>

        <!-- Preview Pane -->
        <main class="flex-1 bg-surface-muted flex flex-col relative overflow-hidden">
            <!-- Loading Indicator -->
            <div id="loader" class="hidden absolute inset-0 bg-white/80 backdrop-blur-sm z-20 items-center justify-center">
                <div class="flex flex-col items-center gap-3">
                    <div class="w-10 h-10 border-4 border-brand-primary border-t-transparent rounded-full animate-spin"></div>
                    <span class="text-xs font-semibold text-text-secondary">Rendering PDF Document...</span>
                </div>
            </div>

            <!-- Empty State -->
            <div id="empty-state" class="absolute inset-0 flex flex-col items-center justify-center p-12 text-center">
                <div class="w-20 h-20 rounded-2xl bg-white border border-subtle flex items-center justify-center text-text-muted shadow-sm mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="hero-title text-xl font-bold text-brand-accent mb-2">No Template Selected</h3>
                <p class="text-sm text-text-secondary max-w-sm leading-relaxed mb-6">
                    Select a PDF template from the sidebar to compile it with mock data and stream the preview in real-time.
                </p>
            </div>

            <!-- Iframe Container -->
            <iframe id="preview-iframe" class="hidden w-full h-full border-none z-10" src=""></iframe>
        </main>
    </div>

    <!-- Script for Live Interaction -->
    <script>
        function selectTemplate(type) {
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
            const url = `/previews/pdfs/view/${type}`;
            iframe.src = url;
            newTabBtn.href = url;

            // Handle Active States in Sidebar
            const buttons = document.querySelectorAll('aside button');
            buttons.forEach(btn => {
                btn.classList.remove('bg-brand-primary/5', 'border-brand-primary/20', 'shadow-sm');
                btn.classList.add('border-transparent');
            });

            const activeBtn = document.getElementById(`btn-${type}`);
            if (activeBtn) {
                activeBtn.classList.remove('border-transparent');
                activeBtn.classList.add('bg-brand-primary/5', 'border-brand-primary/20', 'shadow-sm');
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
