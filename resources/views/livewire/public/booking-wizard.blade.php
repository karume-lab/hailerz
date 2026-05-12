<div class="bg-surface-muted min-h-screen py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($isComplete)
            <x-card padding="p-16" class="text-center shadow-2xl">
                <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-brand-primary/10 mb-10">
                    <x-lucide-check class="h-12 w-12 text-brand-primary" stroke-width="2" />
                </div>
                <x-heading level="h2" title="We've Got Your Request!" class="text-text-primary mb-6" />
                <p class="text-lg text-text-secondary mb-12 max-w-xl mx-auto">
                    Thanks for reaching out! We've sent a summary of your event details to your inbox. 
                    One of our agents will review everything and get back to you within one business day with a formal proposal.
                </p>
                <x-button variant="primary" href="/talent" wire:navigate>
                    Browse Talent
                </x-button>
            </x-card>
        @else
            <x-heading 
                align="center" 
                title="Start your booking" 
                class="mb-16"
            />
            <p class="mt--12 mb-16 text-center text-lg text-text-secondary">Fill in the details below so we can find the right artist for your event.</p>

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

            <x-card padding="p-10 sm:p-16" class="shadow-2xl">
                <form wire:submit.prevent="submit" class="flex flex-col h-full">
                    <!-- Scrollable Content Area -->
                    <div class="flex-1 overflow-y-auto max-h-[60vh] pr-4 -mr-4 scrollbar-thin scrollbar-thumb-brand-primary/20 scrollbar-track-transparent" data-lenis-prevent>
                        <!-- Step 1: Contact Information -->
                        <div class="{{ $currentStep != 1 ? 'hidden' : 'block' }} space-y-10">
                            <h3 class="text-2xl font-bold text-text-primary ">Contact Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <x-input wire:model="first_name" name="first_name" label="First Name *" autocomplete="given-name" />
                                <x-input wire:model="last_name" name="last_name" label="Last Name *" autocomplete="family-name" />
                                <x-input wire:model="email" name="email" type="email" label="Email Address *" autocomplete="email" />
                                <x-input wire:model="phone" name="phone" label="Phone Number *" autocomplete="tel" />
                                <x-input wire:model="company" name="company" label="Company/Organization" class="md:col-span-2" />
                            </div>
                        </div>

                        <!-- Step 2: Event Details -->
                        <div class="{{ $currentStep != 2 ? 'hidden' : 'block' }} space-y-10">
                            <h3 class="text-2xl font-bold text-text-primary ">Event Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <x-select wire:model="event_type" name="event_type" label="Event Type *">
                                    <option value="">-- Select Type --</option>
                                    <option value="Wedding">Wedding</option>
                                    <option value="Corporate Event">Corporate Event</option>
                                    <option value="Private Party">Private Party</option>
                                    <option value="Concert/Festival">Concert/Festival</option>
                                    <option value="Other">Other</option>
                                </x-select>
                                <x-input wire:model="event_date" name="event_date" type="date" label="Event Date *" />
                                <x-input wire:model="event_time" name="event_time" type="time" label="Event Time" />
                                <x-select wire:model="performance_duration" name="performance_duration" label="Performance Duration">
                                    <option value="">-- Select Duration --</option>
                                    <option value="30 Minutes">30 Minutes</option>
                                    <option value="1 Hour">1 Hour</option>
                                    <option value="2 Hours">2 Hours</option>
                                    <option value="3+ Hours">3+ Hours</option>
                                </x-select>
                                <x-input wire:model="venue_name" name="venue_name" label="Venue Name" class="md:col-span-2" />
                                <x-input wire:model="city" name="city" label="City *" />
                                <x-input wire:model="state" name="state" label="State *" />
                                <x-input wire:model="expected_guests" name="expected_guests" type="number" label="Expected Number of Guests *" class="md:col-span-2" />
                            </div>
                        </div>

                        <!-- Step 3: Talent Preferences -->
                        <div class="{{ $currentStep != 3 ? 'hidden' : 'block' }} space-y-10">
                            <h3 class="text-2xl font-bold text-text-primary ">Talent Preferences</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <x-select wire:model="talent_category" name="talent_category" label="Talent Category *">
                                    <option value="">-- Select Category --</option>
                                    <option value="Musicians">Musicians</option>
                                    <option value="Speakers">Speakers</option>
                                    <option value="DJs">DJs</option>
                                    <option value="Comedians">Comedians</option>
                                    <option value="Other">Other</option>
                                </x-select>
                                <x-input wire:model="preferred_genre" name="preferred_genre" label="Preferred Genre" />
                                <x-select wire:model="budget_range" name="budget_range" label="Budget Range">
                                    <option value="">-- Select Budget --</option>
                                    <option value="Under ₦1,000">Under ₦1,000</option>
                                    <option value="₦1,000 - ₦2,500">₦1,000 - ₦2,500</option>
                                    <option value="₦2,500 - ₦5,000">₦2,500 - ₦5,000</option>
                                    <option value="₦5,000 - ₦10,000">₦5,000 - ₦10,000</option>
                                    <option value="₦10,000+">₦10,000+</option>
                                </x-select>
                                <div class="md:col-span-2">
                                    <label for="specific_talent" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Specific Talent Request</label>
                                    
                                    @if($selectedTalent)
                                        <!-- Selected Talent Card -->
                                        <div class="bg-surface-muted border border-brand-primary/20 rounded-2xl p-6 flex items-center justify-between group shadow-sm">
                                            <div class="flex items-center gap-6">
                                                <div class="h-16 w-16 rounded-xl overflow-hidden shadow-md">
                                                    <img src="{{ $selectedTalent->profile_photo_url }}" alt="{{ $selectedTalent->name }}" class="w-full h-full object-cover">
                                                </div>
                                                <div>
                                                    <h4 class="text-lg font-bold text-text-primary">{{ $selectedTalent->name }}</h4>
                                                    <p class="text-sm text-brand-primary font-medium">{{ $selectedTalent->category->name }}</p>
                                                    @if($selectedTalent->starting_price)
                                                        <p class="text-xs text-text-muted mt-1">Starting from ₦{{ number_format($selectedTalent->starting_price) }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <x-button type="button" wire:click="clearTalent" variant="outline" size="sm" class="rounded-lg">
                                                Change Talent
                                            </x-button>
                                        </div>
                                    @else
                                        <!-- Custom Browsable Talent Selector -->
                                        <div x-data="{ open: false }" class="relative">
                                            <!-- Trigger -->
                                            <button type="button" 
                                                @click="open = !open"
                                                class="w-full flex items-center justify-between px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium transition-all text-left">
                                                <span class="text-text-muted">-- Select from Talent --</span>
                                                <x-lucide-chevron-down class="h-5 w-5 text-text-muted transition-transform duration-300" x-bind:class="{ 'rotate-180': open }" stroke-width="2" />
                                            </button>

                                            <!-- Dropdown Menu -->
                                            <div x-show="open" 
                                                x-cloak
                                                @click.away="open = false"
                                                class="absolute z-50 w-full mt-2 bg-surface-light border border-subtle rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-128">
                                                
                                                <!-- Search Bar Inside Dropdown -->
                                                <div class="p-4 border-b border-subtle bg-surface-muted/30">
                                                    <x-input 
                                                        wire:model.live.debounce.300ms="talentSearch"
                                                        placeholder="Search talent..."
                                                        icon="search"
                                                        class="py-3! text-sm!"
                                                    />
                                                </div>

                                                <!-- Talent List -->
                                                <ul class="flex-1 overflow-y-auto divide-y divide-subtle min-h-48">
                                                    @forelse($this->searchableTalents as $talent)
                                                        <li wire:key="talent-{{ $talent->id }}"
                                                            wire:click="selectTalent({{ $talent->id }})"
                                                            @click="open = false"
                                                            class="p-4 flex items-center gap-4 hover:bg-surface-muted cursor-pointer transition-colors group">
                                                            <div class="h-12 w-12 rounded-lg overflow-hidden shrink-0 shadow-sm group-hover:shadow-md transition-shadow">
                                                                <img src="{{ $talent->profile_photo_url }}" alt="{{ $talent->name }}" class="w-full h-full object-cover">
                                                            </div>
                                                            <div class="flex-1 min-w-0">
                                                                <p class="text-sm font-bold text-text-primary truncate">{{ $talent->name }}</p>
                                                                <p class="text-xs text-text-muted">{{ $talent->category->name }}</p>
                                                            </div>
                                                            @if($talent->starting_price)
                                                                <div class="text-right">
                                                                    <p class="text-xs font-bold text-brand-primary">₦{{ number_format($talent->starting_price) }}</p>
                                                                </div>
                                                            @endif
                                                        </li>
                                                    @empty
                                                        <li class="p-12 text-center">
                                                            <p class="text-text-muted italic text-sm">No talents found matching your search.</p>
                                                        </li>
                                                    @endforelse
                                                </ul>
                                                
                                                @if($this->searchableTalents->count() >= $talentLimit)
                                                    <div class="p-4 bg-surface-muted text-center border-t border-subtle">
                                                        <button type="button" wire:click="loadMoreTalents" class="text-xs font-bold text-brand-primary hover:underline">
                                                            Load more talents
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    @error('specific_talent') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="md:col-span-2">
                                    <x-textarea wire:model="additional_details" name="additional_details" label="Additional Details" rows="5" placeholder="Tell us about the event vibe, technical needs, or any special requests." />
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Misc -->
                        <div class="{{ $currentStep != 4 ? 'hidden' : 'block' }} space-y-10">
                            <h3 class="text-2xl font-bold text-text-primary ">Final Details</h3>
                            <x-select wire:model="source" name="source" label="How did you hear about us?">
                                <option value="">-- Select Option --</option>
                                <option value="Search Engine">Search Engine</option>
                                <option value="Social Media">Social Media</option>
                                <option value="Word of Mouth">Word of Mouth</option>
                                <option value="Advertisement">Advertisement</option>
                                <option value="Other">Other</option>
                            </x-select>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="flex items-center justify-end gap-4 mt-16 pt-10 border-t border-subtle">
                        @if($currentStep > 1)
                            <x-button type="button" variant="outline" wire:click="previousStep">
                                Previous Step
                            </x-button>
                        @endif

                        @if($currentStep < 4)
                            <x-button type="button" variant="primary" wire:click="nextStep">
                                Continue
                            </x-button>
                        @else
                            <x-button variant="primary" type="submit" wire:target="submit">
                                Send booking request
                            </x-button>
                        @endif
                    </div>
                </form>
            </x-card>
        @endif
    </div>
</div>
