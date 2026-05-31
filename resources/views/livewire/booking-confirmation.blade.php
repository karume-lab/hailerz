<div class="min-h-[80vh] flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Subtle Background Glows -->
    <div
        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-150 h-150 bg-brand-primary/5 rounded-full blur-[100px] pointer-events-none">
    </div>

    <x-card padding="p-10 sm:p-16"
        class="relative max-w-2xl w-full mx-auto text-center shadow-2xl backdrop-blur-xl border border-subtle/50 reveal">
        <!-- Pre-Heading -->
        <div class="flex items-center justify-center gap-4 mb-8 reveal reveal-delay-200">
            <span class="h-px w-16 bg-linear-to-r from-transparent to-brand-primary/50"></span>
            <span
                class="text-xs font-bold text-brand-primary uppercase tracking-[0.3em] bg-brand-primary/10 px-5 py-2 rounded-full shadow-sm">Inquiry
                Received</span>
            <span class="h-px w-16 bg-linear-to-l from-transparent to-brand-primary/50"></span>
        </div>

        <!-- Main Heading -->
        <h1 class="text-4xl sm:text-5xl font-extrabold text-text-primary mb-8 tracking-tight reveal reveal-delay-300">
            You're All <span
                class="text-transparent bg-clip-text bg-linear-to-r from-brand-primary to-brand-primary/60">Set!</span>
        </h1>

        <!-- Description -->
        <p
            class="text-lg sm:text-xl text-text-secondary mb-12 leading-relaxed font-light max-w-lg mx-auto reveal reveal-delay-400">
            We've successfully received your booking request. Our dedicated team is reviewing the details and will
            contact you within <span class="font-bold text-text-primary">{{ config('hailerz.response_time') }}</span> to help bring your event to
            life.
        </p>

        <!-- Next Steps Box -->
        <div
            class="bg-surface-muted/50 border border-subtle rounded-2xl p-6 mb-12 flex flex-col items-center justify-center text-center reveal reveal-delay-500 hover:bg-surface-muted transition-colors duration-300 shadow-inner">
            <x-heroicon-o-envelope class="w-6 h-6 text-brand-primary mb-3" />
            <p class="text-sm font-medium text-text-primary">
                We've sent a confirmation of your booking to your email.
            </p>
            <p class="text-[10px] text-text-muted mt-2 uppercase tracking-widest font-bold">Please check your spam
                folder just in case.</p>
        </div>

        <!-- Call to Action -->
        <div class="reveal reveal-delay-600">
            <x-button variant="primary" size="lg" href="/marketplace/talent" wire:navigate
                class="w-full sm:w-auto px-10 py-4 shadow-[0_10px_30px_-10px_rgba(var(--color-brand-primary),0.5)] hover:shadow-[0_10px_40px_-10px_rgba(var(--color-brand-primary),0.8)] transition-all duration-300 transform hover:-translate-y-1">
                Browse More Talent
            </x-button>
        </div>

        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-32 h-32 bg-brand-primary/10 rounded-br-full blur-2xl pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 right-0 w-40 h-40 bg-brand-primary/5 rounded-tl-full blur-2xl pointer-events-none">
        </div>
    </x-card>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            localStorage.removeItem('hailerz_booking_wizard_form');
        });
    </script>
</div>