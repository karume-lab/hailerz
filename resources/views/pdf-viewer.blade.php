<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Viewer | Hailerz Testing</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface-light text-text-primary antialiased min-h-screen flex items-center justify-center">
  <div class="max-w-4xl mx-auto px-4 py-16 sm:px-6 lg:px-8 w-full">
    <div class="mb-12">
      <h1 class="text-3xl font-bold tracking-tight text-text-primary mb-4">PDF Document Viewer</h1>
      <p class="text-text-secondary leading-relaxed">Preview how different PDF templates will be rendered across the platform without triggering any emails or database changes. This endpoint is strictly for local testing.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      
      <!-- Talent Representation Agreement -->
      <a href="/view-pdfs/talent-representation-agreement" target="_blank" class="block p-6 bg-white border border-subtle rounded-xl hover:border-brand-primary/50 hover:shadow-lg transition-all duration-300 group">
        <div class="flex items-center gap-4 mb-4">
          <div class="w-10 h-10 rounded-lg bg-brand-primary/10 flex items-center justify-center text-brand-primary group-hover:bg-brand-primary group-hover:text-white transition-colors">
            <x-lucide-file-text class="w-5 h-5" />
          </div>
          <h2 class="text-lg font-semibold text-text-primary group-hover:text-brand-primary transition-colors">Talent Agreement</h2>
        </div>
        <p class="text-sm text-text-secondary mb-4">Preview the Talent Representation Agreement, including the appended Certificate of Completion simulating a fully signed contract.</p>
        <span class="text-xs font-bold text-brand-primary uppercase tracking-widest flex items-center gap-1">
          View PDF <x-lucide-arrow-right class="w-3 h-3 group-hover:translate-x-1 transition-transform" />
        </span>
      </a>

      <!-- Booking Inquiry -->
      <a href="/view-pdfs/booking-inquiry" target="_blank" class="block p-6 bg-white border border-subtle rounded-xl hover:border-brand-primary/50 hover:shadow-lg transition-all duration-300 group">
        <div class="flex items-center gap-4 mb-4">
          <div class="w-10 h-10 rounded-lg bg-brand-primary/10 flex items-center justify-center text-brand-primary group-hover:bg-brand-primary group-hover:text-white transition-colors">
            <x-lucide-calendar class="w-5 h-5" />
          </div>
          <h2 class="text-lg font-semibold text-text-primary group-hover:text-brand-primary transition-colors">Booking Inquiry</h2>
        </div>
        <p class="text-sm text-text-secondary mb-4">Preview the PDF that is generated when an event organizer submits a booking inquiry via the public storefront.</p>
        <span class="text-xs font-bold text-brand-primary uppercase tracking-widest flex items-center gap-1">
          View PDF <x-lucide-arrow-right class="w-3 h-3 group-hover:translate-x-1 transition-transform" />
        </span>
      </a>

      <!-- Talent Submission -->
      <a href="/view-pdfs/talent-submission" target="_blank" class="block p-6 bg-white border border-subtle rounded-xl hover:border-brand-primary/50 hover:shadow-lg transition-all duration-300 group">
        <div class="flex items-center gap-4 mb-4">
          <div class="w-10 h-10 rounded-lg bg-brand-primary/10 flex items-center justify-center text-brand-primary group-hover:bg-brand-primary group-hover:text-white transition-colors">
            <x-lucide-user-plus class="w-5 h-5" />
          </div>
          <h2 class="text-lg font-semibold text-text-primary group-hover:text-brand-primary transition-colors">Talent Submission</h2>
        </div>
        <p class="text-sm text-text-secondary mb-4">Preview the PDF dossier generated when a prospective artist applies to join the agency roster.</p>
        <span class="text-xs font-bold text-brand-primary uppercase tracking-widest flex items-center gap-1">
          View PDF <x-lucide-arrow-right class="w-3 h-3 group-hover:translate-x-1 transition-transform" />
        </span>
      </a>

    </div>
  </div>
</body>
</html>
