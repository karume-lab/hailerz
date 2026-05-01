<div class="bg-surface-muted min-h-screen py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($isComplete)
            <div class="bg-surface-light rounded-[2.5rem] p-16 text-center shadow-2xl border border-subtle">
                <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-brand-primary/10 mb-10">
                    <svg class="h-12 w-12 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h2 class="text-4xl font-bold text-text-primary mb-6 font-serif">Inquiry Submitted Successfully!</h2>
                <p class="text-lg text-text-secondary mb-12 max-w-xl mx-auto">
                    A confirmation email has been sent to your inbox with a PDF summary of your event details. One of our agents will review your request and get back to you within one business day with a formal proposal.
                </p>
                <x-button variant="primary" size="lg" href="/talent" wire:navigate>
                    Browse Talent
                </x-button>
            </div>
        @else
            <div class="mb-16 text-center">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <span class="h-px w-8 bg-brand-primary"></span>
                    <span class="text-xs font-bold text-brand-primary uppercase tracking-widest">Inquiry Wizard</span>
                    <span class="h-px w-8 bg-brand-primary"></span>
                </div>
                <h1 class="text-4xl md:text-6xl font-bold text-text-primary tracking-tight font-serif">Start your booking</h1>
                <p class="mt-4 text-lg text-text-secondary">Fill in the details below so we can find the right artist for your event.</p>
            </div>

            <!-- Progress Indicator -->
            <div class="mb-16">
                <div class="relative">
                    <div class="overflow-hidden h-1.5 mb-6 text-xs flex rounded-full bg-subtle">
                        <div style="width: {{ ($currentStep / 4) * 100 }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-text-inverse justify-center bg-brand-primary transition-all duration-700"></div>
                    </div>
                    <div class="grid grid-cols-4 text-[10px] font-bold text-text-muted uppercase tracking-[0.2em]">
                        <span class="{{ $currentStep >= 1 ? 'text-brand-primary' : '' }} text-left">Contact</span>
                        <span class="{{ $currentStep >= 2 ? 'text-brand-primary' : '' }} text-center">Event</span>
                        <span class="{{ $currentStep >= 3 ? 'text-brand-primary' : '' }} text-center">Preferences</span>
                        <span class="{{ $currentStep >= 4 ? 'text-brand-primary' : '' }} text-right">Misc</span>
                    </div>
                </div>
            </div>

            <div class="bg-surface-light shadow-2xl rounded-[2.5rem] p-10 sm:p-16 border border-subtle">
                <form wire:submit.prevent="submit">
                    <!-- Step 1: Contact Information -->
                    <div class="{{ $currentStep != 1 ? 'hidden' : 'block' }} space-y-10">
                        <h3 class="text-2xl font-bold text-text-primary font-serif">Contact Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="first_name" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">First Name <span class="text-red-500">*</span></label>
                                <input type="text" id="first_name" wire:model="first_name" class="block w-full px-6 py-4 bg-surface-muted border border-subtle placeholder-text-muted rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium transition-all">
                                @error('first_name') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="last_name" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Last Name <span class="text-red-500">*</span></label>
                                <input type="text" id="last_name" wire:model="last_name" class="block w-full px-6 py-4 bg-surface-muted border border-subtle placeholder-text-muted rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium transition-all">
                                @error('last_name') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Email Address <span class="text-red-500">*</span></label>
                                <input type="email" id="email" wire:model="email" class="block w-full px-6 py-4 bg-surface-muted border border-subtle placeholder-text-muted rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium transition-all">
                                @error('email') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="phone" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Phone Number <span class="text-red-500">*</span></label>
                                <input type="text" id="phone" wire:model="phone" class="block w-full px-6 py-4 bg-surface-muted border border-subtle placeholder-text-muted rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium transition-all">
                                @error('phone') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label for="company" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Company/Organization</label>
                                <input type="text" id="company" wire:model="company" class="block w-full px-6 py-4 bg-surface-muted border border-subtle placeholder-text-muted rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium transition-all">
                                @error('company') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Event Details -->
                    <div class="{{ $currentStep != 2 ? 'hidden' : 'block' }} space-y-10">
                        <h3 class="text-2xl font-bold text-text-primary font-serif">Event Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="event_type" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Event Type <span class="text-red-500">*</span></label>
                                <select id="event_type" wire:model="event_type" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium transition-all">
                                    <option value="">-- Select Type --</option>
                                    <option value="Wedding">Wedding</option>
                                    <option value="Corporate Event">Corporate Event</option>
                                    <option value="Private Party">Private Party</option>
                                    <option value="Concert/Festival">Concert/Festival</option>
                                    <option value="Other">Other</option>
                                </select>
                                @error('event_type') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="event_date" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Event Date <span class="text-red-500">*</span></label>
                                <input type="date" id="event_date" wire:model="event_date" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium transition-all">
                                @error('event_date') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="event_time" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Event Time</label>
                                <input type="time" id="event_time" wire:model="event_time" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium transition-all">
                                @error('event_time') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="performance_duration" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Performance Duration</label>
                                <select id="performance_duration" wire:model="performance_duration" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium transition-all">
                                    <option value="">-- Select Duration --</option>
                                    <option value="30 Minutes">30 Minutes</option>
                                    <option value="1 Hour">1 Hour</option>
                                    <option value="2 Hours">2 Hours</option>
                                    <option value="3+ Hours">3+ Hours</option>
                                </select>
                                <p class="text-[10px] text-text-muted mt-2 italic">How long would you like the artist to be on stage?</p>
                                @error('performance_duration') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label for="venue_name" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Venue Name</label>
                                <input type="text" id="venue_name" wire:model="venue_name" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium transition-all">
                                @error('venue_name') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="city" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">City <span class="text-red-500">*</span></label>
                                <input type="text" id="city" wire:model="city" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium transition-all">
                                @error('city') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="state" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">State <span class="text-red-500">*</span></label>
                                <input type="text" id="state" wire:model="state" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium transition-all">
                                @error('state') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label for="expected_guests" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Expected Number of Guests <span class="text-red-500">*</span></label>
                                <input type="number" id="expected_guests" wire:model="expected_guests" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium transition-all">
                                <p class="text-[10px] text-text-muted mt-2 italic">Estimated attendance helps us scale the technical and sound requirements.</p>
                                @error('expected_guests') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Talent Preferences -->
                    <div class="{{ $currentStep != 3 ? 'hidden' : 'block' }} space-y-10">
                        <h3 class="text-2xl font-bold text-text-primary font-serif">Talent Preferences</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="talent_category" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Talent Category <span class="text-red-500">*</span></label>
                                <select id="talent_category" wire:model="talent_category" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium transition-all">
                                    <option value="">-- Select Category --</option>
                                    <option value="Musicians">Musicians</option>
                                    <option value="Speakers">Speakers</option>
                                    <option value="DJs">DJs</option>
                                    <option value="Comedians">Comedians</option>
                                    <option value="Other">Other</option>
                                </select>
                                @error('talent_category') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="preferred_genre" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Preferred Genre</label>
                                <input type="text" id="preferred_genre" wire:model="preferred_genre" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium transition-all">
                                @error('preferred_genre') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="budget_range" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Budget Range</label>
                                <select id="budget_range" wire:model="budget_range" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium transition-all">
                                    <option value="">-- Select Budget --</option>
                                    <option value="Under ₦1,000">Under ₦1,000</option>
                                    <option value="₦1,000 - ₦2,500">₦1,000 - ₦2,500</option>
                                    <option value="₦2,500 - ₦5,000">₦2,500 - ₦5,000</option>
                                    <option value="₦5,000 - ₦10,000">₦5,000 - ₦10,000</option>
                                    <option value="₦10,000+">₦10,000+</option>
                                </select>
                                <p class="text-[10px] text-text-muted mt-2 italic">Total estimated budget for the talent, inclusive of fees.</p>
                                @error('budget_range') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="specific_talent" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Specific Talent Request</label>
                                <input type="text" id="specific_talent" wire:model="specific_talent" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium transition-all">
                                <p class="text-[10px] text-text-muted mt-2 italic">Leave blank if you'd like us to recommend a curated list of performers.</p>
                                @error('specific_talent') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label for="additional_details" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Additional Details</label>
                                <textarea id="additional_details" wire:model="additional_details" rows="5" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium transition-all resize-none"></textarea>
                                <p class="text-[10px] text-text-muted mt-2 italic">Tell us about the event vibe, technical needs, or any special requests.</p>
                                @error('additional_details') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Misc -->
                    <div class="{{ $currentStep != 4 ? 'hidden' : 'block' }} space-y-10">
                        <h3 class="text-2xl font-bold text-text-primary font-serif">Final Details</h3>
                        <div>
                            <label for="source" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">How did you hear about us?</label>
                            <select id="source" wire:model="source" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium transition-all">
                                <option value="">-- Select Option --</option>
                                <option value="Search Engine">Search Engine</option>
                                <option value="Social Media">Social Media</option>
                                <option value="Word of Mouth">Word of Mouth</option>
                                <option value="Advertisement">Advertisement</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('source') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="flex items-center justify-between mt-16 pt-10 border-t border-subtle">
                        @if($currentStep > 1)
                            <x-button type="button" variant="ghost" wire:click="previousStep">
                                Previous Step
                            </x-button>
                        @else
                            <div></div>
                        @endif

                        @if($currentStep < 4)
                            <x-button type="button" variant="primary" size="lg" wire:click="nextStep">
                                Continue
                            </x-button>
                        @else
                            <x-button variant="navy" size="lg" type="submit" wire:loading.attr="disabled" wire:target="submit">
                                <span wire:loading.remove wire:target="submit">Send booking request</span>
                                <span wire:loading wire:target="submit" class="flex items-center justify-center">
                                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                            </x-button>
                        @endif
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>
