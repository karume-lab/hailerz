<div class="bg-surface-muted min-h-screen py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        {{-- Hero Header --}}
        <div class="text-center mb-24">
            <x-heading level="h1" title="Get In Touch" align="center" class="mb-6" />
            <p class="text-xl text-text-secondary max-w-2xl mx-auto font-light">
                Have questions? Need help finding talent? We're here to assist you.
            </p>
        </div>

        <div class="lg:grid lg:grid-cols-12 lg:gap-16">
            {{-- Left Column: Contact Information --}}
            <div class="lg:col-span-5 space-y-8">
                <div>
                    <h2 class="text-2xl font-bold text-text-primary mb-4">Contact Information</h2>
                    <p class="text-text-secondary leading-relaxed mb-8 font-light">
                        Reach out through any of these channels and we'll respond promptly.
                    </p>
                </div>

                <x-card padding="p-8" class="shadow-xl border-none space-y-8">
                    {{-- Phone --}}
                    <div class="flex items-start gap-6">
                        <div
                            class="h-12 w-12 rounded-2xl bg-brand-primary/10 flex items-center justify-center text-brand-primary shrink-0">
                            <x-lucide-phone class="w-5 h-5" stroke-width="2" />
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-text-primary mb-1">Phone</h3>
                            <p class="text-text-secondary">+234 8138234230</p>
                            <p class="text-xs text-text-muted mt-1">Mon-Fri, 9am-6pm</p>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="flex items-start gap-6">
                        <div
                            class="h-12 w-12 rounded-2xl bg-brand-primary/10 flex items-center justify-center text-brand-primary shrink-0">
                            <x-lucide-mail class="w-5 h-5" stroke-width="2" />
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-text-primary mb-1">Email</h3>
                            <a href="mailto:info@hailerz.com"
                                class="text-text-secondary hover:text-brand-primary transition-colors">info@hailerz.com</a>
                            <p class="text-xs text-text-muted mt-1">We respond within 24 hours</p>
                        </div>
                    </div>

                    {{-- Office --}}
                    <div class="flex items-start gap-6">
                        <div
                            class="h-12 w-12 rounded-2xl bg-brand-primary/10 flex items-center justify-center text-brand-primary shrink-0">
                            <x-lucide-map-pin class="w-5 h-5" stroke-width="2" />
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-text-primary mb-1">Office</h3>
                            <p class="text-text-secondary leading-relaxed">
                                6 Kolawole Shonibare St.<br>
                                Ilupeju, Lagos, Nigeria
                            </p>
                        </div>
                    </div>

                    {{-- Business Hours --}}
                    <div class="flex items-start gap-6">
                        <div
                            class="h-12 w-12 rounded-2xl bg-brand-primary/10 flex items-center justify-center text-brand-primary shrink-0">
                            <x-lucide-clock class="w-5 h-5" stroke-width="2" />
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-text-primary mb-1">Business Hours</h3>
                            <div class="text-sm text-text-secondary space-y-1">
                                <p>Monday - Friday: 9am - 6pm</p>
                                <p>Saturday: 10am - 4pm</p>
                                <p>Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                </x-card>

                {{-- Book Talent CTA --}}
                <x-card padding="p-8" class="bg-brand-primary/5 border-brand-primary/10 shadow-lg">
                    <h3 class="text-lg font-bold text-text-primary mb-2">Looking to Book Talent?</h3>
                    <p class="text-sm text-text-secondary mb-6 leading-relaxed">
                        For booking inquiries, use our dedicated booking form for faster service.
                    </p>
                    <x-button href="/book" wire:navigate class="w-full" variant="primary">
                        Go to Booking Form
                    </x-button>
                </x-card>
            </div>

            {{-- Right Column: Send Message Form --}}
            <div class="mt-16 lg:mt-0 lg:col-span-7">
                <x-card padding="p-6 md:p-12" class="shadow-2xl border-none relative overflow-hidden">
                    <h2 class="text-2xl font-bold text-text-primary mb-8">Send Us a Message</h2>

                    @if($contactSent)
                        <div class="relative z-10 flex flex-col items-center text-center py-12 gap-6">
                            <div
                                class="h-20 w-20 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                                <x-lucide-check class="w-10 h-10" stroke-width="2" />
                            </div>
                            <h3 class="text-3xl font-bold text-text-primary">Inquiry Received</h3>
                            <p class="text-text-secondary">An agent will review your request and
                                contact you shortly.</p>
                            <button wire:click="$set('contactSent', false)"
                                class="text-brand-primary font-bold hover:underline">Submit another inquiry</button>
                        </div>
                    @else
                                    <form wire:submit="submitContact" class="space-y-6">
                                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                            <x-input wire:model="first_name" name="first_name" label="First Name *"
                                                placeholder="John" />
                                            <x-input wire:model="last_name" name="last_name" label="Last Name *" placeholder="Smith" />
                                        </div>

                                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                            <x-input wire:model="email" name="email" type="email" label="Email Address *"
                                                placeholder="john@example.com" />
                                            <x-input wire:model="phone" name="phone" label="Phone Number"
                                                placeholder="(555) 123-4567" />
                                        </div>

                                        <x-select wire:model="subject" name="subject" label="Subject *" placeholder="Select a subject"
                                            :options="[
                            'General Inquiry' => 'General Inquiry',
                            'Booking Request' => 'Booking Request',
                            'Talent Representation' => 'Talent Representation',
                            'Partnerships' => 'Partnerships',
                            'Other' => 'Other'
                        ]" />

                                        <x-textarea wire:model="message" name="message" label="Message *" rows="5"
                                            placeholder="Tell us how we can help you..." />

                                        <div class="pt-4">
                                            <x-button type="submit" class="w-full shadow-lg shadow-brand-primary/20" size="lg"
                                                variant="primary" wire:loading.attr="disabled" wire:target="submitContact">
                                                <span wire:loading.remove wire:target="submitContact">Send Message</span>
                                                <span wire:loading wire:target="submitContact" class="flex items-center justify-center">
                                                    <x-lucide-loader-2 class="animate-spin h-5 w-5 text-white" stroke-width="2" />
                                                </span>
                                            </x-button>
                                            <p class="text-center text-xs text-text-muted mt-6 font-medium">
                                                We'll respond to your inquiry within 24 hours.
                                            </p>
                                        </div>
                                    </form>
                    @endif
                </x-card>
            </div>
        </div>

        {{-- Bottom Section: Need Something Specific? --}}
        <div class="mt-32 pt-24 border-t border-subtle text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-text-primary mb-4">Need Something Specific?</h2>
            <p class="text-lg text-text-secondary mb-16">Quick links to help you find what you need</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                {{-- Browse Talent --}}
                <x-card padding="p-8" class="flex flex-col h-full bg-surface-light border-subtle">
                    <h3 class="text-xl font-bold text-text-primary mb-4">Browse Talent</h3>
                    <p class="text-sm text-text-secondary mb-8 grow leading-relaxed">
                        Explore our directory of musicians, bands, DJs, and speakers
                    </p>
                    <x-button href="/talent" wire:navigate variant="outline" size="sm" class="w-full">
                        View Directory
                    </x-button>
                </x-card>

                {{-- Book Talent --}}
                <x-card padding="p-8" class="flex flex-col h-full bg-surface-light border-subtle">
                    <h3 class="text-xl font-bold text-text-primary mb-4">Book Talent</h3>
                    <p class="text-sm text-text-secondary mb-8 grow leading-relaxed">
                        Submit a booking inquiry and get matched with perfect performers
                    </p>
                    <x-button href="/book" wire:navigate variant="outline" size="sm" class="w-full">
                        Start Booking
                    </x-button>
                </x-card>

                {{-- FAQs --}}
                <x-card padding="p-8" class="flex flex-col h-full bg-surface-light border-subtle">
                    <h3 class="text-xl font-bold text-text-primary mb-4">FAQs</h3>
                    <p class="text-sm text-text-secondary mb-8 grow leading-relaxed">
                        Find answers to commonly asked questions about our services
                    </p>
                    <x-button href="/#faqs" wire:navigate variant="outline" size="sm" class="w-full">
                        Read FAQs
                    </x-button>
                </x-card>
            </div>
        </div>
    </div>
</div>