<div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-32 text-center">
    <div class="mb-12 inline-flex items-center justify-center w-24 h-24 bg-brand-primary/10 text-brand-primary rounded-full shadow-sm shadow-brand-primary/20">
        <x-heroicon-o-check class="w-12 h-12 stroke-3" />
    </div>
    
    <div class="flex items-center justify-center gap-3 mb-6">
        <span class="h-px w-12 bg-brand-primary"></span>
        <span class="text-xs font-bold text-brand-primary uppercase tracking-widest">Inquiry Received</span>
        <span class="h-px w-12 bg-brand-primary"></span>
    </div>

    <x-heading level="h1" title="You're All Set!" class="text-text-primary mb-8" />
    
    <p class="text-xl text-text-secondary mb-12 leading-relaxed font-light">
        We've received your booking request and our team is already on it. 
        One of our expert agents will review the details and get in touch with you within 24 hours to help bring your event to life.
    </p>
    
    <div class="space-y-6">
        <x-button variant="primary" size="lg" href="/talent" wire:navigate>
            Browse More Talent
        </x-button>
        <p class="text-[10px] font-bold text-text-muted uppercase tracking-widest">
            Check your inbox - we've sent a confirmation of your booking to your email.
        </p>
    </div>
</div>
