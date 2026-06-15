<div class="w-full min-h-screen bg-surface-muted/30 py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Progress Steps -->
        <div class="mb-12 reveal">
            <div class="flex items-center justify-between">
                <!-- Step 1 Indicator -->
                <div class="flex flex-col items-center flex-1">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm transition-all duration-300 {{ $currentStep >= 1 ? 'bg-brand-primary text-text-inverse' : 'bg-surface-light border border-subtle text-text-muted' }}">
                        1
                    </div>
                    <span class="text-xs font-semibold mt-2 tracking-wide uppercase {{ $currentStep >= 1 ? 'text-brand-primary' : 'text-text-muted' }}">Select Tier</span>
                </div>

                <!-- Divider Line -->
                <div class="h-0.5 bg-subtle flex-1 mx-2 transition-all duration-300 {{ $currentStep > 1 ? 'bg-brand-primary' : 'bg-subtle' }}"></div>

                <!-- Step 2 Indicator (Exhibitor Only) -->
                @if($pass_type === 'exhibitor')
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm transition-all duration-300 {{ $currentStep >= 2 ? 'bg-brand-primary text-text-inverse' : 'bg-surface-light border border-subtle text-text-muted' }}">
                            2
                        </div>
                        <span class="text-xs font-semibold mt-2 tracking-wide uppercase {{ $currentStep >= 2 ? 'text-brand-primary' : 'text-text-muted' }}">Company Asset</span>
                    </div>

                    <!-- Divider Line -->
                    <div class="h-0.5 bg-subtle flex-1 mx-2 transition-all duration-300 {{ $currentStep > 2 ? 'bg-brand-primary' : 'bg-subtle' }}"></div>
                @endif

                <!-- Step 3 Indicator -->
                <div class="flex flex-col items-center flex-1">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm transition-all duration-300 {{ $currentStep >= 3 ? 'bg-brand-primary text-text-inverse' : 'bg-surface-light border border-subtle text-text-muted' }}">
                        {{ $pass_type === 'exhibitor' ? '3' : '2' }}
                    </div>
                    <span class="text-xs font-semibold mt-2 tracking-wide uppercase {{ $currentStep >= 3 ? 'text-brand-primary' : 'text-text-muted' }}">Fulfillment</span>
                </div>
            </div>
        </div>

        <!-- Wizard Card using standard x-card component -->
        <x-card bg="light" padding="p-8 sm:p-12" :hover="false" class="reveal reveal-delay-100 shadow-xl border border-brand-primary/10">
            @if($registrationId)
                <!-- Final Success State -->
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-brand-primary/10 rounded-full flex items-center justify-center mx-auto mb-6 text-brand-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-semibold text-brand-accent mb-4 dark:text-text-primary">Registration Confirmed</h2>
                    <p class="text-text-secondary text-base mb-8 max-w-md mx-auto">
                        Your registration for the Hailerz Event & Conference Expo has been processed successfully. Your access ticket and receipt PDFs have been dispatched to your email address.
                    </p>
                    <x-button href="/marketplace-expo/services" variant="primary" size="md" wire:navigate class="hover:scale-105 transition-transform duration-300">
                        Return to Expo Hub
                    </x-button>
                </div>

            @elseif($currentStep === 1)
                <!-- Step 1: Ticket Tier Selection -->
                <div>
                    <h2 class="text-2xl font-semibold text-brand-accent dark:text-text-primary mb-2">Select Your Ticket Tier</h2>
                    <p class="text-text-secondary text-sm mb-8">Choose general event admission or secure a corporate exhibitor booth space inside the expo hall.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                        <!-- Option A: Attendee Pass -->
                        <div 
                            @click="$wire.set('pass_type', 'attendee')" 
                            class="relative p-8 rounded-[2.5rem] border-2 cursor-pointer transition-all hover:border-brand-primary flex flex-col justify-between {{ $pass_type === 'attendee' ? 'border-brand-primary bg-brand-primary/5 shadow-md' : 'border-brand-primary/10 bg-surface-light hover:shadow-sm' }}"
                        >
                            <div>
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-brand-primary bg-brand-primary/10 px-3 py-1 rounded-full">General Pass</span>
                                    <div class="w-5 h-5 rounded-full border-2 border-brand-primary flex items-center justify-center">
                                        @if($pass_type === 'attendee')
                                            <div class="w-2.5 h-2.5 rounded-full bg-brand-primary"></div>
                                        @endif
                                    </div>
                                </div>
                                <h3 class="text-lg font-bold text-text-primary mb-2">General Attendee Pass</h3>
                                <p class="text-text-secondary text-xs leading-relaxed mb-6">
                                    Grants full access to the conference expo floor, primary keynote halls, and designated networking spaces.
                                </p>
                            </div>
                            <div class="text-xl font-extrabold text-brand-primary mt-auto uppercase tracking-wide">
                                Free Entry
                            </div>
                        </div>

                        <!-- Option B: Host / Exhibitor Event -->
                        <div 
                            @click="$wire.set('pass_type', 'exhibitor')" 
                            class="relative p-8 rounded-[2.5rem] border-2 cursor-pointer transition-all hover:border-brand-primary flex flex-col justify-between {{ $pass_type === 'exhibitor' ? 'border-brand-primary bg-brand-primary/5 shadow-md' : 'border-brand-primary/10 bg-surface-light hover:shadow-sm' }}"
                        >
                            <div>
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-brand-accent bg-brand-accent/10 px-3 py-1 rounded-full dark:bg-brand-primary/20 dark:text-brand-primary">Host Space</span>
                                    <div class="w-5 h-5 rounded-full border-2 border-brand-primary flex items-center justify-center">
                                        @if($pass_type === 'exhibitor')
                                            <div class="w-2.5 h-2.5 rounded-full bg-brand-primary"></div>
                                        @endif
                                    </div>
                                </div>
                                <h3 class="text-lg font-bold text-text-primary mb-2">Register Event / Booth</h3>
                                <p class="text-text-secondary text-xs leading-relaxed mb-6">
                                    Includes one dedicated event space or exhibitor booth, customizable digital presentation slots, host/exhibitor credentials for up to 3 staff members, and priority logo placement in displays.
                                </p>
                            </div>
                            <div class="text-xl font-extrabold text-brand-primary mt-auto">
                                {{ number_format($event?->exhibitor_price ?? 350000, 2) }} NGN
                            </div>
                        </div>
                    </div>

                    @guest
                        <div class="mb-10 p-6 bg-surface-muted rounded-2xl border border-subtle space-y-6">
                            <h3 class="text-lg font-bold text-text-primary mb-2">Your Details</h3>
                            <p class="text-text-secondary text-sm mb-4">You are checking out as a guest. Please provide your details to receive your ticket. Already have an account? <a href="/login" class="text-brand-primary font-bold hover:underline">Log in here</a>.</p>
                            
                            <x-input wire:model="guest_name" name="guest_name" label="Full Name *" placeholder="Enter your full name" />
                            <x-input wire:model="guest_email" name="guest_email" label="Email Address *" type="email" placeholder="Enter your email address" />
                            
                            @error('guest_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            @error('guest_email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    @endguest

                    <div class="flex justify-between items-center border-t border-subtle pt-8">
                        <x-confirm-dialog 
                            title="Clear Form" 
                            message="Are you sure you want to clear this form? All your entered details will be lost." 
                            confirmText="Clear Form" 
                            onConfirm="window.location.reload()">
                            <x-button type="button" variant="secondary">
                                Clear Form
                            </x-button>
                        </x-confirm-dialog>
                        <x-button type="button" wire:click="nextStep" size="md">
                            Continue
                        </x-button>
                    </div>
                </div>

            @elseif($currentStep === 2)
                <!-- Step 2: Event Profile & Asset Intake (Exhibitor Only) -->
                <div>
                    <h2 class="text-2xl font-semibold text-brand-accent dark:text-text-primary mb-2">Event Details & Brand Assets</h2>
                    <p class="text-text-secondary text-sm mb-8">Provide details about your event and upload your promotional banner/logo for display in the partner loops.</p>

                    <div class="space-y-6 mb-10">
                        <x-input wire:model="company_name" name="company_name" label="Event Name *" placeholder="Enter event name" />

                        <x-textarea wire:model="company_description" name="company_description" label="Event Description *" placeholder="Provide a brief description of the event..." rows="4" />

                        <div>
                            <x-image-dropzone wire:model="company_logo" label="Event Banner/Poster (Optional)" />
                            <p class="text-xs text-text-muted mt-2">Upload a high-resolution banner. If omitted, a clean initials badge will automatically render.</p>
                            @error('company_logo') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-between items-center border-t border-subtle pt-8">
                        <x-confirm-dialog 
                            title="Clear Form" 
                            message="Are you sure you want to clear this form? All your entered details will be lost." 
                            confirmText="Clear Form" 
                            onConfirm="window.location.reload()">
                            <x-button type="button" variant="secondary">
                                Clear Form
                            </x-button>
                        </x-confirm-dialog>
                        <div class="flex gap-4">
                            <x-button type="button" wire:click="previousStep" variant="secondary" size="md">
                                Back
                            </x-button>
                            <x-button type="button" wire:click="nextStep" size="md">
                                Continue
                            </x-button>
                        </div>
                    </div>
                </div>

            @elseif($currentStep === 3)
                <!-- Step 3: Fulfillment & Checkout Review -->
                <div>
                    <h2 class="text-2xl font-semibold text-brand-accent dark:text-text-primary mb-2">Review & Complete Registration</h2>
                    <p class="text-text-secondary text-sm mb-8">Please double-check your registration details before confirming fulfillment.</p>

                    <div class="bg-surface-muted border border-brand-primary/10 rounded-4xl p-6 mb-8 space-y-4">
                        <div class="flex justify-between items-center border-b border-subtle/50 pb-4">
                            <span class="text-sm font-semibold text-text-secondary">Selected Tier:</span>
                            <span class="text-sm font-bold text-brand-accent dark:text-text-primary uppercase tracking-wide">
                                {{ $pass_type === 'exhibitor' ? 'Register Event / Booth' : 'General Attendee Pass' }}
                            </span>
                        </div>

                        @if($pass_type === 'exhibitor')
                            <div class="flex justify-between items-start border-b border-subtle/50 pb-4">
                                <span class="text-sm font-semibold text-text-secondary">Event Name:</span>
                                <span class="text-sm font-bold text-text-primary text-right">{{ $company_name }}</span>
                            </div>
                            <div class="flex justify-between items-start border-b border-subtle/50 pb-4">
                                <span class="text-sm font-semibold text-text-secondary">Event Description:</span>
                                <span class="text-sm text-text-secondary text-right max-w-xs">{{ $company_description }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-subtle/50 pb-4">
                                <span class="text-sm font-semibold text-text-secondary">Event Banner/Poster:</span>
                                @if($company_logo)
                                    <img src="{{ $company_logo }}" class="h-8 w-auto object-contain border border-subtle rounded px-1 bg-surface-light" alt="Logo">
                                @else
                                    <span class="text-xs text-text-muted">Geometric initials badge fallback active</span>
                                @endif
                            </div>
                        @endif

                        <div class="flex justify-between items-center pt-2">
                            <span class="text-sm font-bold text-text-primary">Fulfillment Cost:</span>
                            <span class="text-lg font-extrabold text-brand-primary">
                                {{ $pass_type === 'exhibitor' ? number_format($event?->exhibitor_price ?? 350000, 2) . ' NGN' : 'Free' }}
                            </span>
                        </div>
                    </div>

                    @error('payment')
                        <div class="mb-6 p-4 rounded-xl bg-brand-crimson/10 border border-brand-crimson/20 text-brand-crimson text-sm">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="flex justify-between items-center border-t border-subtle pt-8">
                        <x-confirm-dialog 
                            title="Clear Form" 
                            message="Are you sure you want to clear this form? All your entered details will be lost." 
                            confirmText="Clear Form" 
                            onConfirm="window.location.reload()">
                            <x-button type="button" variant="secondary">
                                Clear Form
                            </x-button>
                        </x-confirm-dialog>
                        <div class="flex gap-4">
                            <x-button type="button" wire:click="previousStep" variant="secondary" size="md">
                                Back
                            </x-button>
                            
                            <x-button type="button" wire:click="checkout" size="md" class="shadow-lg shadow-brand-accent/15">
                                {{ $pass_type === 'exhibitor' ? 'Pay Now via Paystack' : 'Confirm Registration' }}
                            </x-button>
                        </div>
                    </div>
                </div>
            @endif
        </x-card>
    </div>
</div>
