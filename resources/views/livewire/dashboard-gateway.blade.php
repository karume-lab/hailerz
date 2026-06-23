<div class="space-y-6">
    <div class="flex items-center justify-between border-b border-subtle pb-6">
        <div>
            <h1 class="text-2xl font-bold text-text-primary tracking-tight">Welcome back, {{ auth()->user()->name }}</h1>
            <p class="text-sm text-text-secondary mt-1">Here's what's happening in your workspace today.</p>
        </div>
    </div>

    <!-- Dashboard overview content will go here -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-subtle shadow-sm flex flex-col justify-center items-center text-center h-48">
            <h3 class="text-lg font-bold text-text-primary mb-2">Explore the Hub</h3>
            <p class="text-sm text-text-secondary mb-4">Discover new opportunities and connect with other creatives.</p>
            <a href="/dashboard/whats-new" wire:navigate class="px-4 py-2 bg-brand-primary text-white text-sm font-bold rounded-xl hover:bg-brand-primary/90 transition-colors">
                What's New
            </a>
        </div>
    </div>
</div>
