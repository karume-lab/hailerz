<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer Previews Hub | Hailerz</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at 10% 20%, rgba(27, 129, 155, 0.05) 0%, rgba(255, 255, 255, 0) 100%), #fafafa;
        }

        .hero-title {
            font-family: 'Outfit', sans-serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.04);
        }

        .glass-card:hover {
            box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.08);
        }
    </style>
</head>

<body class="h-full antialiased text-text-primary">
    <!-- Navbar -->
    <nav class="sticky top-0 z-40 bg-white/70 backdrop-blur-md border-b border-subtle">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
             
            </div>
            <div class="flex gap-4">
                <a href="/previews/pdfs"
                    class="text-sm font-semibold text-text-secondary hover:text-brand-primary transition-colors">PDF
                    Previews</a>
                <a href="/previews/emails"
                    class="text-sm font-semibold text-text-secondary hover:text-brand-primary transition-colors">Email
                    Previews</a>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <main class="max-w-7xl mx-auto px-6 py-12">
        <header class="max-w-3xl mb-16 animate-fadeIn">
            <h1 class="hero-title text-4xl sm:text-5xl font-extrabold tracking-tight text-brand-accent mb-6">
                Developer Previews <span
                    class="bg-linear-to-r from-brand-primary to-brand-secondary bg-clip-text text-transparent">Dashboard</span>
            </h1>
            <p class="text-lg text-text-secondary leading-relaxed">
                Welcome to the local template environment. Live preview how outbound PDFs and transaction email
                templates are rendered in real-time with comprehensive mock data, without writing to the database or
                queueing emails.
            </p>
        </header>

        <!-- Previews Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
            <!-- PDF Card -->
            <div
                class="glass-card rounded-3xl p-8 relative overflow-hidden group transition-all duration-300 transform hover:-translate-y-1">
                <div
                    class="absolute -right-16 -top-16 w-48 h-48 bg-brand-primary/5 rounded-full blur-3xl group-hover:bg-brand-primary/10 transition-colors duration-500">
                </div>
                <div class="flex items-start justify-between mb-8">
                    <div
                        class="w-14 h-14 rounded-2xl bg-brand-primary/10 flex items-center justify-center text-brand-primary group-hover:bg-brand-primary group-hover:text-white transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <span
                        class="text-xs font-bold text-brand-primary bg-brand-primary/10 px-3 py-1 rounded-full uppercase tracking-wider">3
                        Templates</span>
                </div>
                <h2
                    class="hero-title text-2xl font-bold mb-4 text-brand-accent group-hover:text-brand-primary transition-colors">
                    PDF Documents</h2>
                <p class="text-text-secondary leading-relaxed mb-8">
                    Generate and preview pixel-perfect PDF agreements, inquiry logs, and talent application dossiers
                    generated dynamically with styling and page templates.
                </p>
                <div class="flex flex-col gap-3">
                    <div class="flex items-center gap-2 text-sm text-text-secondary">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-primary"></span> Talent Representation Agreement
                    </div>
                    <div class="flex items-center gap-2 text-sm text-text-secondary">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-primary"></span> Booking Inquiry PDF
                    </div>
                    <div class="flex items-center gap-2 text-sm text-text-secondary">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-primary"></span> Talent Submission Portfolio
                    </div>
                </div>
                <div class="mt-8 pt-6 border-t border-subtle">
                    <a href="/previews/pdfs"
                        class="inline-flex items-center gap-2 text-sm font-bold text-brand-primary group-hover:gap-3 transition-all duration-300">
                        Enter PDF Previewer
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Emails Card -->
            <div
                class="glass-card rounded-3xl p-8 relative overflow-hidden group transition-all duration-300 transform hover:-translate-y-1">
                <div
                    class="absolute -right-16 -top-16 w-48 h-48 bg-brand-secondary/5 rounded-full blur-3xl group-hover:bg-brand-secondary/10 transition-colors duration-500">
                </div>
                <div class="flex items-start justify-between mb-8">
                    <div
                        class="w-14 h-14 rounded-2xl bg-brand-secondary/10 flex items-center justify-center text-brand-secondary group-hover:bg-brand-secondary group-hover:text-white transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span
                        class="text-xs font-bold text-brand-secondary bg-brand-secondary/10 px-3 py-1 rounded-full uppercase tracking-wider">10
                        Templates</span>
                </div>
                <h2
                    class="hero-title text-2xl font-bold mb-4 text-brand-accent group-hover:text-brand-secondary transition-colors">
                    Email Notifications</h2>
                <p class="text-text-secondary leading-relaxed mb-8">
                    Inspect standard user transaction emails and administrative notification templates compiled with
                    markdown components, headers, and media.
                </p>
                <div class="flex flex-col gap-3">
                    <div class="flex items-center gap-2 text-sm text-text-secondary">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-secondary"></span> Booking Inquiries &
                        Confirmations
                    </div>
                    <div class="flex items-center gap-2 text-sm text-text-secondary">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-secondary"></span> Contracts & Signature Requests
                    </div>
                    <div class="flex items-center gap-2 text-sm text-text-secondary">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-secondary"></span> Talent Submission Notification
                    </div>
                </div>
                <div class="mt-8 pt-6 border-t border-subtle">
                    <a href="/previews/emails"
                        class="inline-flex items-center gap-2 text-sm font-bold text-brand-secondary group-hover:gap-3 transition-all duration-300">
                        Enter Email Previewer
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- System Status -->
        <footer class="mt-12 text-center text-xs text-text-muted">
            <p>Active Environment: <span class="text-brand-primary font-semibold">Local</span> | Platform engine:
                Laravel 11.x</p>
        </footer>
    </main>
</body>

</html>