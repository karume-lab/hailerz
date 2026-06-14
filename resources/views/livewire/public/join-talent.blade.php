<div class="min-h-screen flex flex-col" x-data="{
        storageKey: 'hailerz_join_talent_form',
        init() {
            @if($isSubmitted)
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
                        let gallery = [];
                        Object.keys(data).forEach(key => {
                            if (key.startsWith('gallery.')) {
                                const parts = key.split('.');
                                const index = parseInt(parts[1]);
                                const field = parts[2];
                                if (!gallery[index]) {
                                    gallery[index] = { url: '', title: '', description: '', media_type: 'link' };
                                }
                                gallery[index][field] = data[key];
                            }
                        });

                        this.$nextTick(() => {
                            if (gallery.length > 0) {
                                @this.set('gallery', gallery);
                            }
                            Object.keys(data).forEach(key => {
                                if (!key.startsWith('gallery.')) {
                                    @this.set(key, data[key]);
                                }
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
     }">
    @if($isSubmitted)
        <div class="flex-1 flex items-center justify-center py-24 bg-surface-muted">
            <x-card padding="p-16" class="text-center shadow-2xl max-w-2xl mx-auto">
                <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-brand-primary/10 mb-10">
                    <x-lucide-check class="h-12 w-12 text-brand-primary" stroke-width="2" />
                </div>
                <x-heading level="h2" title="Application Submitted!" align="center" class="text-text-primary mb-6" />
                <p class="text-lg text-text-secondary mb-12 max-w-xl mx-auto">
                    Thanks for sharing your talent with us! We've successfully received your application.
                    Your application is now under review. If your profile is a strong fit, you'll receive a representation contract to formalise the commitment - after which your profile will go live on our platform.
                </p>
                <x-button variant="primary" size="lg" href="/" wire:navigate>
                    Back to Home
                </x-button>
            </x-card>
        </div>
    @else
        <section class="py-24 bg-surface-light border-b border-subtle">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 reveal">
                <div class="max-w-3xl mx-auto text-center flex flex-col items-center">
                    <x-heading level="h1" title="Join the" highlight="Hailerz Roster" align="center" class="mb-6" />
                    <p class="text-xl text-text-secondary leading-relaxed font-light text-center">
                        Are you a talented performer looking to take your career to the next level? Join our exclusive
                        roster of premium talent and get booked for high-profile events across Nigeria.
                    </p>
                </div>
            </div>
        </section>

        <!-- Why Join Section -->
        <section class="py-24 bg-surface-muted">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 reveal">
                    <x-heading level="h2" title="Why Join" highlight="Hailerz?" align="center" class="mb-4" />
                    <p class="text-lg text-text-secondary">We're more than an agency; we're your partner in success</p>
                </div>
                <div class="max-w-5xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @php
                            $benefits = [
                                ['icon' => 'star', 'title' => 'Premium Events', 'desc' => 'Get booked for high-end weddings, corporate events, festivals, and exclusive private parties with top-tier clients.'],
                                ['icon' => 'trending-up', 'title' => 'Career Growth', 'desc' => 'Expand your reach, build your reputation, and increase your earning potential with consistent, quality bookings.'],
                                ['icon' => 'users', 'title' => 'Professional Support', 'desc' => 'Our team handles contracts, negotiations, logistics, and client communications so you can focus on performing.'],
                                ['icon' => 'music', 'title' => 'Marketing & Exposure', 'desc' => 'Featured placement on our platform, social media promotion, and access to our network of event planners.'],
                            ];
                        @endphp

                        @foreach($benefits as $index => $benefit)
                            <div
                                class="rounded-2xl border border-subtle bg-surface-light p-8 shadow-sm reveal {{ $index % 2 === 1 ? 'reveal-delay-100' : '' }}">
                                <div class="flex items-start gap-4">
                                    <div class="bg-brand-primary/10 p-3 rounded-xl">
                                        <x-dynamic-component :component="'lucide-' . $benefit['icon']"
                                            class="h-6 w-6 text-brand-primary" />
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold mb-2 text-text-primary">{{ $benefit['title'] }}</h3>
                                        <p class="text-text-secondary text-sm leading-relaxed">{{ $benefit['desc'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Who We're Looking For -->
        <section class="py-24 bg-surface-light border-y border-subtle">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 reveal">
                    <x-heading level="h2" title="Who We're" highlight="Looking For" align="center" class="mb-4" />
                    <p class="text-lg text-text-secondary">We represent only the best in the industry</p>
                </div>
                <div class="max-w-4xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-16 reveal reveal-delay-200">
                        <div>
                            <h3 class="text-xl font-bold mb-6 flex items-center gap-3 text-text-primary">
                                <x-lucide-mic class="h-6 w-6 text-brand-primary" />
                                Talent Categories
                            </h3>
                            <ul class="space-y-4 text-text-secondary">
                                <li class="flex items-center gap-3">
                                    <x-lucide-circle-check class="h-5 w-5 text-brand-primary" />
                                    Solo Musicians (Vocalists, Instrumentalists)
                                </li>
                                <li class="flex items-center gap-3">
                                    <x-lucide-circle-check class="h-5 w-5 text-brand-primary" />
                                    Variety Artists (All genres)
                                </li>
                                <li class="flex items-center gap-3">
                                    <x-lucide-circle-check class="h-5 w-5 text-brand-primary" />
                                    DJs (Wedding, Corporate, Club)
                                </li>
                                <li class="flex items-center gap-3">
                                    <x-lucide-circle-check class="h-5 w-5 text-brand-primary" />
                                    Speakers & Entertainers
                                </li>
                                <li class="flex items-center gap-3">
                                    <x-lucide-circle-check class="h-5 w-5 text-brand-primary" />
                                    Specialty Acts
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-6 flex items-center gap-3 text-text-primary">
                                <x-lucide-radio class="h-6 w-6 text-brand-primary" />
                                Requirements
                            </h3>
                            <ul class="space-y-4 text-text-secondary">
                                <li class="flex items-center gap-3">
                                    <x-lucide-circle-check class="h-5 w-5 text-brand-primary" />
                                    Professional performance experience
                                </li>
                                <li class="flex items-center gap-3">
                                    <x-lucide-circle-check class="h-5 w-5 text-brand-primary" />
                                    High-quality performance videos/recordings
                                </li>
                                <li class="flex items-center gap-3">
                                    <x-lucide-circle-check class="h-5 w-5 text-brand-primary" />
                                    Reliable and professional demeanor
                                </li>
                                <li class="flex items-center gap-3">
                                    <x-lucide-circle-check class="h-5 w-5 text-brand-primary" />
                                    Own equipment (where applicable)
                                </li>
                                <li class="flex items-center gap-3">
                                    <x-lucide-circle-check class="h-5 w-5 text-brand-primary" />
                                    Available for international events
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-brand-primary/20 bg-brand-primary/5 p-8 reveal reveal-delay-400">
                        <div class="flex items-start gap-4">
                            <x-lucide-message-square class="h-6 w-6 text-brand-primary shrink-0 mt-1" />
                            <div>
                                <h3 class="text-lg font-bold mb-2 text-text-primary">Selection Process</h3>
                                <p class="text-text-secondary leading-relaxed">
                                    We carefully review every application against our current roster needs and
                                    client base. Successful applicants will be sent a representation contract
                                    to sign - once countersigned, your profile will be made publicly available
                                    for booking on the Hailerz platform.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Form Section -->
        <section class="py-24 bg-surface-muted" id="apply">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 reveal">
                    <x-heading level="h2" title="Talent" highlight="Application" align="center" class="mb-4" />
                    <p class="text-lg text-text-secondary">Take the first step toward joining our premier roster</p>
                </div>

                <!-- Progress Indicator -->
                <div class="mb-16 reveal reveal-delay-100">
                    <div class="relative">
                        <div class="overflow-hidden h-1.5 mb-6 text-xs flex rounded-full bg-subtle">
                            <div style="width: {{ ($currentStep / 4) * 100 }}%"
                                class="shadow-none flex flex-col text-center whitespace-nowrap text-text-inverse justify-center bg-brand-primary transition-all duration-700">
                            </div>
                        </div>
                        <div class="grid grid-cols-4 text-[10px] font-bold text-text-muted uppercase tracking-[0.2em]">
                            <span class="{{ $currentStep >= 1 ? 'text-brand-primary' : '' }} text-left">Basics</span>
                            <span
                                class="{{ $currentStep >= 2 ? 'text-brand-primary' : '' }} text-center">Professional</span>
                            <span class="{{ $currentStep >= 3 ? 'text-brand-primary' : '' }} text-center">Portfolio</span>
                            <span class="{{ $currentStep >= 4 ? 'text-brand-primary' : '' }} text-right">Review</span>
                        </div>
                    </div>
                </div>

                <x-card padding="p-8 sm:p-12" class="shadow-xl reveal reveal-delay-200">
                    <form wire:submit.prevent="submit" class="space-y-12">
                        <!-- Step 1: Artist Information -->
                        <div class="{{ $currentStep != 1 ? 'hidden' : 'block' }} space-y-10">
                            <h3 class="text-2xl font-bold text-text-primary border-b border-subtle pb-4">Act Information
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="md:col-span-2">
                                    <label
                                        class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-4">Talent
                                        Type *</label>
                                    <div class="grid grid-cols-2 gap-4">
                                        <button type="button" wire:click="$set('talent_type', 'individual')"
                                            class="flex items-center justify-center gap-3 p-4 rounded-xl border {{ $talent_type === 'individual' ? 'border-brand-primary bg-brand-primary/5 text-brand-primary' : 'border-subtle bg-surface-light text-text-secondary hover:border-brand-primary/30' }} transition-all">
                                            <x-lucide-user class="w-5 h-5" />
                                            <span class="font-bold">Individual</span>
                                        </button>
                                        <button type="button" wire:click="$set('talent_type', 'group')"
                                            class="flex items-center justify-center gap-3 p-4 rounded-xl border {{ $talent_type === 'group' ? 'border-brand-primary bg-brand-primary/5 text-brand-primary' : 'border-subtle bg-surface-light text-text-secondary hover:border-brand-primary/30' }} transition-all">
                                            <x-lucide-users class="w-5 h-5" />
                                            <span class="font-bold">Group / Band</span>
                                        </button>
                                    </div>
                                </div>

                                @if($talent_type === 'group')
                                    <div class="md:col-span-2">
                                        <x-input wire:model.live.debounce.300ms="member_count" type="number" label="Number of Members *"
                                            placeholder="e.g. 4" />
                                    </div>
                                @endif

                                <x-input wire:model.live.debounce.300ms="artist_name" label="Act Name *" placeholder="Your stage name" />
                                <x-input wire:model.live.debounce.300ms="real_name" label="Full Name *" placeholder="Your legal name" />
                                <x-input wire:model.live.debounce.300ms="email" type="email" label="Email Address *"
                                    placeholder="your@email.com" />
                                <x-input wire:model.live.debounce.300ms="phone" type="tel" label="Phone Number *"
                                    placeholder="+1 XXX XXX XXXX" />
                                <div class="md:col-span-2">
                                    <x-input wire:model.live.debounce.300ms="location" label="Location (City, Country) *"
                                        placeholder="London, UK" :location="true" />
                                </div>
                                <div class="md:col-span-2">
                                    <x-image-dropzone wire:model="profile_photo_url" label="Profile Photo *" />
                                    <p class="text-xs text-text-muted mt-2">Provide a high-quality promotional photo or logo.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Professional Details -->
                        <div class="{{ $currentStep != 2 ? 'hidden' : 'block' }} space-y-10">
                            <h3 class="text-2xl font-bold text-text-primary border-b border-subtle pb-4">Professional
                                Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <x-select wire:model.live="category" label="Talent Category *">
                                    <option value="">Select category</option>
                                    <option value="Musicians">Musicians</option>
                                    <option value="DJs">DJs</option>
                                    <option value="Speakers">Speakers</option>
                                    <option value="Dancers">Dancers</option>
                                    <option value="Artists">Artists</option>
                                    <option value="Poets">Poets</option>
                                    <option value="Content Creators">Content Creators</option>
                                    <option value="Comedians">Comedians</option>
                                    <option value="MCs">MCs</option>
                                    <option value="Variety Artists">Variety Artists</option>
                                </x-select>
                                <x-input wire:model.live.debounce.300ms="genre" label="Primary Genre/Style (Optional)"
                                    placeholder="e.g., Afrobeats, Jazz, Hip-Hop" />
                                <x-input wire:model.live.debounce.300ms="years_active" label="Years Active *" placeholder="e.g., 5 years" />
                                <div class="grid grid-cols-2 gap-4">
                                    <x-input wire:model.live.debounce.300ms="min_rate" type="number"
                                        label="Min Rate ({{ \App\Helpers\CurrencyHelper::getCurrencySymbol() }}) *"
                                        placeholder="e.g. 500" min="{{ config('paystack.min_amount', 100) }}" />
                                    <x-input wire:model.live.debounce.300ms="max_rate" type="number"
                                        label="Max Rate ({{ \App\Helpers\CurrencyHelper::getCurrencySymbol() }}) *"
                                        placeholder="e.g. 1500" min="{{ config('paystack.min_amount', 100) }}" />
                                </div>
                                <div class="md:col-span-2">
                                    <x-textarea wire:model.live.debounce.300ms="bio" label="Artist Bio *" rows="5"
                                        placeholder="Tell us about yourself, your style, and what makes you unique as a performer (min 200 characters)"
                                        maxlength="5000" />
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Portfolio & Socials -->
                        <div class="{{ $currentStep != 3 ? 'hidden' : 'block' }} space-y-10">
                            <h3 class="text-2xl font-bold text-text-primary border-b border-subtle pb-4">Portfolio & Socials
                            </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <x-input wire:model.live.debounce.300ms="instagram_handle" label="Instagram Username"
                                        prefix="instagram.com/" placeholder="yourusername" />
                                    <x-input wire:model.live.debounce.300ms="facebook_url" label="Facebook Username/Page Name"
                                        prefix="facebook.com/" placeholder="yourusername" />
                                    <x-input wire:model.live.debounce.300ms="youtube_channel" label="YouTube Channel Name/Handle"
                                        prefix="youtube.com/@" placeholder="yourchannel" />
                                    <x-input wire:model.live.debounce.300ms="tiktok_handle" label="TikTok Username"
                                        prefix="tiktok.com/@" placeholder="yourusername" />
                                    <x-input wire:model.live.debounce.300ms="website_url" type="url" label="Website URL"
                                        placeholder="https://yourwebsite.com" class="md:col-span-2" />
                                </div>

                                <div class="space-y-6">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-lg font-bold text-text-primary">Gallery</h4>
                                        <x-button type="button" variant="secondary" size="sm" wire:click="addGalleryItem">
                                            <x-lucide-plus class="w-4 h-4 mr-2" />
                                            Add to Gallery
                                        </x-button>
                                    </div>
                                    <div class="space-y-4">
                                        @foreach($gallery as $index => $item)
                                            <div class="bg-surface-muted/50 p-6 rounded-2xl border border-subtle relative">
                                                <button type="button" wire:click="removeGalleryItem({{ $index }})"
                                                    class="absolute top-4 right-4 text-text-muted hover:text-red-500 transition-colors">
                                                    <x-lucide-x class="w-4 h-4" />
                                                </button>
                                                <div class="grid grid-cols-1 gap-6">
                                                    <x-select wire:model.live="gallery.{{ $index }}.media_type" label="Media Type">
                                                        <option value="link">External Link</option>
                                                        <option value="image">Image Upload</option>
                                                    </x-select>

                                                    @if(($gallery[$index]['media_type'] ?? 'link') === 'link')
                                                        <x-input wire:model.live.debounce.500ms="gallery.{{ $index }}.url" label="Media Link *"
                                                            placeholder="YouTube, SoundCloud, or Drive link" />
                                                    @else
                                                        <x-image-dropzone wire:model="gallery.{{ $index }}.url" label="Upload Image *" />
                                                    @endif

                                                    @if(($gallery[$index]['media_type'] ?? 'link') === 'link' && !empty($gallery[$index]['url']) && (filter_var($gallery[$index]['url'], FILTER_VALIDATE_URL) || str_starts_with($gallery[$index]['url'], 'data:image/')))
                                                        <div class="p-4 bg-surface-muted/30 border border-subtle rounded-2xl">
                                                            <span
                                                                class="text-[10px] font-bold text-text-muted uppercase tracking-widest block mb-3">Media
                                                                Preview</span>
                                                            {!! \App\Helpers\MediaPreviewHelper::getPreviewHtml($gallery[$index]['url']) !!}
                                                        </div>
                                                    @endif

                                                    <x-input wire:model.live.debounce.300ms="gallery.{{ $index }}.title" label="Title (Optional)"
                                                        placeholder="e.g. Live Performance at Eko Hotel" />
                                                    <x-textarea wire:model.live.debounce.300ms="gallery.{{ $index }}.description"
                                                        label="Description (Optional)"
                                                        placeholder="Short description of this media..." rows="3"
                                                        maxlength="1000" />
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        <!-- Step 4: Final Review & Next Steps -->
                        <div class="{{ $currentStep != 4 ? 'hidden' : 'block' }} space-y-10">
                            <h3 class="text-2xl font-bold text-text-primary border-b border-subtle pb-4">Final Review & Next
                                Steps</h3>

                            <div class="bg-surface-muted rounded-2xl p-8 border border-subtle">
                                <h4 class="text-sm font-bold text-text-primary uppercase tracking-widest mb-6">Application
                                    Process</h4>
                                <ul class="space-y-4">
                                    <li class="flex items-start gap-4 text-sm text-text-secondary">
                                        <div
                                            class="h-6 w-6 rounded-full bg-brand-primary/10 flex items-center justify-center shrink-0">
                                            <span class="text-[10px] font-bold text-brand-primary">1</span>
                                        </div>
                                        <p>Our team reviews your portfolio and credentials to assess fit with our current roster and client needs.</p>
                                    </li>
                                    <li class="flex items-start gap-4 text-sm text-text-secondary">
                                        <div
                                            class="h-6 w-6 rounded-full bg-brand-primary/10 flex items-center justify-center shrink-0">
                                            <span class="text-[10px] font-bold text-brand-primary">2</span>
                                        </div>
                                        <p>If approved, you'll receive a representation contract to review and sign - formalising your commitment to the Hailerz network.</p>
                                    </li>
                                    <li class="flex items-start gap-4 text-sm text-text-secondary">
                                        <div
                                            class="h-6 w-6 rounded-full bg-brand-primary/10 flex items-center justify-center shrink-0">
                                            <span class="text-[10px] font-bold text-brand-primary">3</span>
                                        </div>
                                        <p>Once your contract is signed, your profile goes live and becomes publicly available for booking by our premium clients.</p>
                                    </li>
                                </ul>
                            </div>

                            <div class="space-y-6">
                                <x-select wire:model.live="source" label="How did you hear about us?">
                                    <option value="">Select an option</option>
                                    <option value="social">Social Media</option>
                                    <option value="referral">Artist Referral</option>
                                    <option value="search">Search Engine</option>
                                    <option value="other">Other</option>
                                </x-select>
 
                                <label for="is_accurate"
                                    class="cursor-pointer relative flex items-start p-6 bg-brand-primary/5 hover:bg-brand-primary/10 transition-colors rounded-xl border border-brand-primary/10">
                                    <div class="flex h-6 items-center">
                                        <input wire:model.live="is_accurate" id="is_accurate" name="is_accurate" type="checkbox"
                                            class="cursor-pointer h-4 w-4 rounded border-brand-primary/30 text-brand-primary focus:ring-brand-primary">
                                    </div>
                                    <div class="ml-4 text-sm leading-6">
                                        <span class="block font-bold text-text-primary">Information Accuracy
                                            *</span>
                                        <p class="text-text-secondary text-xs">I confirm that all professional information
                                            and media provided are accurate and my own work.</p>
                                        @error('is_accurate') <p class="text-red-500 text-[10px] mt-1 font-bold">
                                        {{ $message }}</p> @enderror
                                    </div>
                                </label>

                                <p class="text-[10px] text-text-muted leading-relaxed text-center italic">
                                    By submitting, you agree to our <a href="{{ route('legal.privacy') }}" wire:navigate
                                        class="underline">Privacy Policy</a>.
                                    Your data is used strictly for recruitment and contact purposes.
                                </p>
                            </div>
                        </div>

                        <!-- Navigation -->
                        <div class="flex items-center justify-between mt-16 pt-10 border-t border-subtle">
                            <x-confirm-dialog 
                                title="Clear Form" 
                                message="Are you sure you want to clear this form? All your entered details will be lost." 
                                confirmText="Clear Form" 
                                onConfirm="localStorage.removeItem(storageKey); window.location.reload()">
                                <x-button type="button" variant="secondary">
                                    Clear Form
                                </x-button>
                            </x-confirm-dialog>
                            <div class="flex items-center gap-4">
                                @if($currentStep > 1)
                                    <x-button type="button" variant="secondary" wire:click="previousStep">
                                        Back
                                    </x-button>
                                @endif

                                @if($currentStep < 4)
                                    <x-button type="button" variant="primary" wire:click="nextStep">
                                        Next Step
                                    </x-button>
                                @else
                                    <x-button variant="accent" size="lg" type="submit" class="px-10 h-14"
                                        wire:loading.attr="disabled">
                                        Submit Application
                                    </x-button>
                                @endif
                            </div>
                        </div>
                    </form>
                </x-card>
            </div>
        </section>
    @endif
</div>