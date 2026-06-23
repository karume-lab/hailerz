<x-layouts.app>
    <x-slot:title>{{ $event ? $event->title : 'Event' }} | Hailerz</x-slot>

    <div class="w-full bg-[#f9fafb] min-h-screen py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="text-xs text-text-muted mb-8">
                <a href="/marketplace-expo/browse" class="hover:text-brand-primary">Discover</a> / <span class="text-text-primary">{{ $event ? $event->title : 'Event' }}</span>
            </div>

            <div class="flex flex-col md:flex-row gap-12 bg-white p-8 rounded-3xl shadow-sm border border-subtle/50">
                <!-- Left Column (Image & Button) -->
                <div class="w-full md:w-2/5 flex flex-col gap-6">
                    <div class="aspect-square bg-surface-muted rounded-2xl overflow-hidden border border-subtle shadow-sm relative">
                        @if($event && $event->banner_image)
                            <img src="{{ Storage::url($event->banner_image) }}" class="w-full h-full object-cover" alt="{{ $event->title }}">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-text-muted text-sm font-semibold p-4 text-center">
                                <x-lucide-image class="w-12 h-12 mb-2 opacity-50" />
                                No Banner Image Available
                            </div>
                        @endif
                    </div>
                    
                    <a href="/marketplace-expo/tickets?tier=exhibitor" wire:navigate class="w-full flex items-center justify-center py-3.5 bg-brand-primary hover:bg-brand-primary/90 text-white rounded-xl text-sm font-bold shadow-md hover:shadow-lg transition-all">
                        Get a Ticket
                    </a>
                </div>

                <!-- Right Column (Details) -->
                <div class="w-full md:w-3/5">
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-brand-accent mb-8 leading-tight">{{ $event ? $event->title : 'Event Title' }}</h1>
                    
                    <div class="space-y-5 text-sm text-text-secondary mb-10 border-b border-subtle pb-10">
                        <div class="flex items-center gap-3">
                            <x-lucide-calendar class="w-5 h-5 text-text-muted" />
                            <span class="font-medium">{{ $event ? $event->date->format('l, F jS Y') : 'Date' }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <x-lucide-clock class="w-5 h-5 text-text-muted" />
                            <span class="font-medium">9:00 AM - 5:00 PM UTC</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <x-lucide-map-pin class="w-5 h-5 text-text-muted" />
                            <span class="font-medium">{{ $event ? $event->location : 'Location' }}</span>
                        </div>
                    </div>

                    <div class="mb-10 border-b border-subtle pb-10">
                        <h2 class="font-extrabold text-lg text-brand-accent mb-6">About this event</h2>
                        <div class="prose max-w-none text-sm text-text-secondary leading-relaxed">
                            {!! $event ? $event->description : 'No description provided.' !!}
                        </div>
                    </div>

                    <div class="mb-10 border-b border-subtle pb-10">
                        <h2 class="font-extrabold text-lg text-brand-accent mb-6">Hosted by</h2>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-brand-primary/10 flex items-center justify-center text-brand-primary shadow-sm border border-subtle">
                                <img src="{{ asset('images/logo.webp') }}" alt="Hailerz" class="w-7 h-auto">
                            </div>
                            <div>
                                <div class="font-bold text-brand-accent text-sm">Hailerz Global Talent</div>
                                <div class="text-xs text-text-muted mt-0.5">@Hailerz</div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h2 class="font-extrabold text-lg text-brand-accent mb-6">Contact Us</h2>
                        <div class="flex items-center gap-6 text-text-muted">
                            <a href="/" class="hover:text-brand-primary transition-colors"><x-lucide-globe class="w-5 h-5" /></a>
                            <a href="https://www.instagram.com/hailerzdotcom/" target="_blank" rel="noopener" class="hover:text-brand-primary transition-colors"><x-lucide-instagram class="w-5 h-5" /></a>
                            <a href="https://twitter.com/hailerzdotcom" target="_blank" rel="noopener" class="hover:text-brand-primary transition-colors"><x-lucide-twitter class="w-5 h-5" /></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-layouts.app>