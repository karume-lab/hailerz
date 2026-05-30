<div class="bg-surface-muted min-h-screen py-24"
     x-data="{
        storageKey: 'hailerz_booking_wizard_form',
        init() {
            @if($isComplete)
                localStorage.removeItem(this.storageKey);
                return;
            @endif

            const saved = localStorage.getItem(this.storageKey);
            if (saved) {
                try {
                    const parsed = JSON.parse(saved);
                    const age = Date.now() - parsed.timestamp;
                    if (age > 86400000) {
                        localStorage.removeItem(this.storageKey);
                    } else {
                        const data = parsed.data || {};
                        this.$nextTick(() => {
                            Object.keys(data).forEach(key => {
                                @this.set(key, data[key]);
                            });
                            if (parsed.currentStep) {
                                @this.set('currentStep', parsed.currentStep);
                            }
                        });
                    }
                } catch (e) {
                    localStorage.removeItem(this.storageKey);
                }
            }

            this.$watch('$wire.currentStep', () => this.saveData());

            $el.addEventListener('input', () => this.saveData());
            $el.addEventListener('change', () => this.saveData());
        },
        saveData() {
            let data = {};
            $el.querySelectorAll('[wire\\:model],[wire\\:model\\.blur],[wire\\:model\\.live],[wire\\:model\\.defer],[wire\\:model\\.live\\.debounce\\.300ms],[wire\\:model\\.live\\.debounce\\.500ms]').forEach(el => {
                const model = el.getAttributeNames().find(a => a.startsWith('wire:model')) ? el.getAttribute(el.getAttributeNames().find(a => a.startsWith('wire:model'))) : null;
                if (model) {
                    if (el.type === 'checkbox') {
                        data[model] = el.checked;
                    } else {
                        data[model] = el.value;
                    }
                }
            });
            localStorage.setItem(this.storageKey, JSON.stringify({
                timestamp: Date.now(),
                data: data,
                currentStep: this.$wire.currentStep
            }));
        }
     }"
>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-heading 
                align="center" 
                title="Start your booking" 
                class="mb-16 reveal"
            />
            <p class="mt--12 mb-16 text-center text-lg text-text-secondary reveal reveal-delay-100">Fill in the details below so we can find the right artist for your event.</p>

            <!-- Progress Indicator -->
            <div class="mb-16 reveal reveal-delay-200">
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

            <x-card padding="p-10 sm:p-16" class="shadow-2xl reveal reveal-delay-300">
                <form wire:submit.prevent="submit" class="flex flex-col h-full">
                    <!-- Scrollable Content Area -->
                    <div class="flex-1 overflow-y-auto max-h-[60vh] pr-4 -mr-4 scrollbar-thin scrollbar-thumb-brand-primary/20 scrollbar-track-transparent" data-lenis-prevent>
                        <!-- Step 1: Contact Information -->
                        <div class="{{ $currentStep != 1 ? 'hidden' : 'block' }} space-y-10">
                            <h3 class="text-2xl font-bold text-text-primary ">Contact Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <x-input wire:model.live.debounce.300ms="first_name" name="first_name" label="First Name *" autocomplete="given-name" />
                                <x-input wire:model.live.debounce.300ms="last_name" name="last_name" label="Last Name *" autocomplete="family-name" />
                                <x-input wire:model.live.debounce.300ms="email" name="email" type="email" label="Email Address *" autocomplete="email" />
                                <x-input wire:model.live.debounce.300ms="phone" name="phone" label="Phone Number *" autocomplete="tel" />
                                <x-input wire:model.live.debounce.300ms="company" name="company" label="Company/Organization" class="md:col-span-2" />
                            </div>
                        </div>

                        <!-- Step 2: Event Details -->
                        <div class="{{ $currentStep != 2 ? 'hidden' : 'block' }} space-y-10">
                            <h3 class="text-2xl font-bold text-text-primary ">Event Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <x-select wire:model.live="event_type" name="event_type" label="Event Type *">
                                    <option value="">-- Select Type --</option>
                                    <option value="Wedding">Wedding</option>
                                    <option value="Corporate Event">Corporate Event</option>
                                    <option value="Private Party">Private Party</option>
                                    <option value="Concert/Festival">Concert/Festival</option>
                                    <option value="Other">Other</option>
                                </x-select>
                                <x-input wire:model.live.debounce.300ms="event_date" name="event_date" type="date" label="Event Date *" />
                                <x-input wire:model.live.debounce.300ms="event_time" name="event_time" type="time" label="Event Time" />
                                <x-select wire:model.live="performance_duration" name="performance_duration" label="Performance Duration">
                                    <option value="">-- Select Duration --</option>
                                    <option value="30 Minutes">30 Minutes</option>
                                    <option value="1 Hour">1 Hour</option>
                                    <option value="2 Hours">2 Hours</option>
                                    <option value="3+ Hours">3+ Hours</option>
                                </x-select>
                                <x-input wire:model.live.debounce.300ms="venue_name" name="venue_name" label="Venue Name" class="md:col-span-2" />
                                <x-input wire:model.live.debounce.300ms="city" name="city" label="City *" :location="true" locationType="city" />
                                <x-input wire:model.live.debounce.300ms="state" name="state" label="State *" :location="true" locationType="state" />
                                <x-input wire:model.live.debounce.300ms="expected_guests" name="expected_guests" type="number" label="Expected Number of Guests *" class="md:col-span-2" />
                            </div>
                        </div>

                        <!-- Step 3: Talent Preferences -->
                        <div class="{{ $currentStep != 3 ? 'hidden' : 'block' }} space-y-10">
                            <h3 class="text-2xl font-bold text-text-primary ">Talent Preferences</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <x-select wire:model.live="talent_category" name="talent_category" label="Talent Category *">
                                    <option value="">-- Select Category --</option>
                                    <option value="Musicians">Musicians</option>
                                    <option value="Speakers">Speakers</option>
                                    <option value="DJs">DJs</option>
                                    <option value="Comedians">Comedians</option>
                                    <option value="Other">Other</option>
                                </x-select>
                                <x-input wire:model.live.debounce.300ms="preferred_genre" name="preferred_genre" label="Preferred Genre" />
                                <div class="relative">
                                    <x-input wire:model.live.debounce.300ms="budget_range" name="budget_range" label="Budget Range *" placeholder="Select or type budget (e.g. 10k - 20k)" list="budget-options" />
                                    <datalist id="budget-options">
                                        @foreach(\App\Helpers\CurrencyHelper::getBudgetOptions() as $option)
                                            <option value="{{ $option }}">
                                        @endforeach
                                    </datalist>
                                    <p class="text-[10px] text-text-muted mt-2">You can select a range or type your specific budget.</p>
                                </div>
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
                                                        <p class="text-xs text-text-muted mt-1">Starting from {{ \App\Helpers\CurrencyHelper::format($selectedTalent->starting_price) }}</p>
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
                                                            @if(!$talent->is_frozen) 
                                                                wire:click="selectTalent({{ $talent->id }})"
                                                                @click="open = false"
                                                                class="p-4 flex items-center gap-4 hover:bg-surface-muted cursor-pointer transition-colors group"
                                                            @else
                                                                class="p-4 flex items-center gap-4 bg-surface-muted/30 cursor-not-allowed opacity-60 grayscale transition-colors group"
                                                            @endif
                                                        >
                                                            <div class="h-12 w-12 rounded-lg overflow-hidden shrink-0 shadow-sm {{ !$talent->is_frozen ? 'group-hover:shadow-md transition-shadow' : '' }} relative">
                                                                <img src="{{ $talent->profile_photo_url }}" alt="{{ $talent->name }}" class="w-full h-full object-cover">
                                                                @if($talent->is_frozen)
                                                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                                                                        <x-lucide-lock class="w-4 h-4 text-white" />
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="flex-1 min-w-0">
                                                                <div class="flex items-center gap-2">
                                                                    <p class="text-sm font-bold text-text-primary truncate">{{ $talent->name }}</p>
                                                                    @if($talent->is_frozen)
                                                                        <span class="text-[8px] font-bold bg-red-100 text-red-600 px-1.5 py-0.5 rounded uppercase tracking-wider">Frozen</span>
                                                                    @endif
                                                                </div>
                                                                <p class="text-xs text-text-muted">{{ $talent->category->name }}</p>
                                                            </div>
                                                            @if($talent->starting_price)
                                                                <div class="text-right">
                                                                    <p class="text-xs font-bold text-brand-primary">{{ \App\Helpers\CurrencyHelper::format($talent->starting_price) }}</p>
                                                                    @if($talent->is_frozen)
                                                                        <p class="text-[8px] text-red-500 font-bold mt-1">Unavailable</p>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        </li>
                                                    @empty
                                                        <li class="p-12 text-center">
                                                            <div class="mb-4 opacity-20 flex justify-center">
                                                                <x-lucide-search-x class="w-12 h-12 text-text-muted" />
                                                            </div>
                                                            <p class="text-text-muted italic text-sm">No talents found matching your criteria.</p>
                                                            @if($budget_range)
                                                                <div class="mt-6 p-4 bg-brand-primary/5 rounded-xl border border-brand-primary/10">
                                                                    <p class="text-xs text-brand-primary font-bold uppercase tracking-wider mb-2">Budget Filter Active</p>
                                                                    <p class="text-xs text-text-secondary leading-relaxed">Not getting what you are looking for? Try adjusting the budget to view more talent.</p>
                                                                    <button type="button" wire:click="$set('budget_range', '')" class="text-xs font-bold text-brand-primary underline mt-3 block mx-auto">Clear Budget Filter</button>
                                                                </div>
                                                            @endif
                                                        </li>
                                                    @endforelse
                                                </ul>

                                                @if($budget_range && $this->searchableTalents->count() > 0)
                                                    <div class="p-3 bg-brand-primary/5 text-center border-t border-subtle">
                                                        <p class="text-[9px] font-bold text-brand-primary uppercase tracking-widest">
                                                            Only showing talent within {{ $budget_range }}. 
                                                            <button type="button" wire:click="$set('budget_range', '')" class="underline ml-1">View All</button>
                                                        </p>
                                                    </div>
                                                @endif
                                                
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
                                    <x-textarea wire:model.live.debounce.300ms="additional_details" name="additional_details" label="Additional Details" rows="5" placeholder="Tell us about the event vibe, technical needs, or any special requests." maxlength="2000" />
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Misc -->
                        <div class="{{ $currentStep != 4 ? 'hidden' : 'block' }} space-y-10">
                            <h3 class="text-2xl font-bold text-text-primary ">Final Details & Next Steps</h3>
                            
                            <div class="bg-surface-muted rounded-2xl p-8 border border-subtle">
                                <h4 class="text-sm font-bold text-text-primary uppercase tracking-widest mb-6">What happens next?</h4>
                                <ul class="space-y-4">
                                    <li class="flex items-start gap-4 text-sm text-text-secondary">
                                        <div class="h-6 w-6 rounded-full bg-brand-primary/10 flex items-center justify-center shrink-0">
                                            <span class="text-[10px] font-bold text-brand-primary">1</span>
                                        </div>
                                        <p>Hailerz will review your inquiry and contact the artist(s) to verify availability.</p>
                                    </li>
                                    <li class="flex items-start gap-4 text-sm text-text-secondary">
                                        <div class="h-6 w-6 rounded-full bg-brand-primary/10 flex items-center justify-center shrink-0">
                                            <span class="text-[10px] font-bold text-brand-primary">2</span>
                                        </div>
                                        <p>We will obtain a final quote based on your specific requirements.</p>
                                    </li>
                                    <li class="flex items-start gap-4 text-sm text-text-secondary">
                                        <div class="h-6 w-6 rounded-full bg-brand-primary/10 flex items-center justify-center shrink-0">
                                            <span class="text-[10px] font-bold text-brand-primary">3</span>
                                        </div>
                                        <p>Expect a formal proposal from us within <strong>{{ config('hailerz.response_time') }}</strong>.</p>
                                    </li>
                                </ul>
                            </div>

                            <div class="space-y-6">
                                <x-select wire:model.live="source" name="source" label="How did you hear about us?">
                                    <option value="">-- Select Option --</option>
                                    <option value="Search Engine">Search Engine</option>
                                    <option value="Social Media">Social Media</option>
                                    <option value="Word of Mouth">Word of Mouth</option>
                                    <option value="Advertisement">Advertisement</option>
                                    <option value="Other">Other</option>
                                </x-select>
 
                                @error('payment')
                                    <div class="mb-4 p-4 bg-red-50 text-red-600 rounded-xl text-sm font-bold border border-red-200 w-full text-center">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="relative flex items-start p-4 bg-brand-primary/5 rounded-xl border border-brand-primary/10">
                                    <div class="flex h-6 items-center">
                                        <input wire:model.live="is_accurate" id="is_accurate" name="is_accurate" type="checkbox" class="h-4 w-4 rounded border-brand-primary/30 text-brand-primary focus:ring-brand-primary">
                                    </div>
                                    <div class="ml-4 text-sm leading-6">
                                        <label for="is_accurate" class="font-bold text-text-primary">Information Accuracy *</label>
                                        <p class="text-text-secondary text-xs">I confirm that the information provided in this form is accurate and complete.</p>
                                        @error('is_accurate') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                <p class="text-[10px] text-text-muted leading-relaxed text-center italic">
                                    By submitting this form, you agree to our <a href="{{ route('legal.privacy') }}" wire:navigate class="underline">Privacy Policy</a>. 
                                    Your information is used solely for contact purposes regarding this inquiry. We do not sell or share your data with third parties.
                                </p>
                            </div>
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
                                Secure Booking via Paystack
                            </x-button>
                        @endif
                    </div>
                </form>
            </x-card>
    </div>
</div>
