<div class="bg-surface-muted min-h-screen"
     x-data="{
        storageKey: 'hailerz_staffing_form',
        init() {
            @if($requestSent)
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
                        });
                    }
                } catch (e) {
                    localStorage.removeItem(this.storageKey);
                }
            }

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
                data: data
            }));
        }
     }"
>
    <!-- Hero Section -->
    <section class="relative bg-surface-dark pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                <!-- Left Content: Heading & Video -->
                <div class="lg:col-span-5 space-y-12 reveal">
                    <div class="space-y-6">
                        <x-heading level="h1" title="Scale your team with" highlight="professional services." highlightClass="text-[#65c4af]" class="text-white" />
                        <p class="text-xl text-white/70 max-w-2xl leading-relaxed">
                            Effortlessly scale your project capacity with creative talent. From specialized consultants to remote creative talent, we provide the professional staff augmentation your business requires.
                        </p>
                    </div>

                    <!-- Video Representation UI -->
                    <div class="relative max-w-2xl">
                        <div x-data="{ play: false }"
                            class="aspect-video bg-white/5 backdrop-blur-sm rounded-3xl border border-white/10 overflow-hidden shadow-2xl relative group cursor-pointer">
                            
                            <template x-if="play">
                                <iframe class="w-full h-full"
                                    src="https://www.youtube.com/embed/LLdr6BqljEw?autoplay=1&mute=1&rel=0"
                                    title="Hailerz - How it Works" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                </iframe>
                            </template>

                            <template x-if="!play">
                                <div @click="play = true" class="absolute inset-0 w-full h-full flex items-center justify-center">
                                    <!-- Background Poster Image (YouTube MaxRes Default Thumbnail) -->
                                    <img src="https://i.ytimg.com/vi/LLdr6BqljEw/maxresdefault.jpg" 
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                                         alt="Hailerz - How it Works video preview" loading="lazy" decoding="async">
                                    
                                    <!-- Overlay gradient -->
                                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition-colors duration-300"></div>
                                    
                                    <!-- Centered premium play button with pulse effect -->
                                    <div class="absolute flex items-center justify-center">
                                        <div class="absolute w-20 h-20 rounded-full bg-brand-primary/30 animate-ping pointer-events-none"></div>
                                        <div class="relative z-10 w-16 h-16 rounded-full bg-brand-primary/95 text-white flex items-center justify-center shadow-[0_10px_40px_rgba(27,129,155,0.5)] transition-all duration-300 group-hover:scale-110 group-hover:bg-brand-primary active:scale-95"
                                             role="button" aria-label="Play video">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 translate-x-0.5 text-white">
                                                <path d="M8 5v14l11-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Floating elements for visual flair -->
                        <div class="absolute -top-6 -right-6 w-16 h-16 bg-brand-secondary/20 rounded-full blur-2xl">
                        </div>
                        <div class="absolute -bottom-8 -left-8 w-24 h-24 bg-brand-primary/10 rounded-full blur-3xl">
                        </div>
                    </div>
                </div>

                <!-- Right Content: Form -->
                <div class="lg:col-span-7 reveal reveal-delay-200" id="request-form">
                    <x-card padding="p-8 lg:p-10" class="shadow-2xl border-none relative overflow-hidden">
                        @if($requestSent)
                            <div class="text-center py-12 space-y-6">
                                <div
                                    class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto">
                                    <x-lucide-check class="w-10 h-10" />
                                </div>
                                <div class="space-y-2">
                                    <h3 class="text-2xl font-bold text-text-primary">Request Received</h3>
                                    <p class="text-text-secondary">We'll be in touch with you shortly to discuss your
                                        staffing needs.</p>
                                </div>
                                <x-button variant="outline" wire:click="$set('requestSent', false)">Send Another
                                    Request</x-button>
                            </div>
                        @else
                            <div class="mb-8">
                                <h2 class="text-3xl font-bold text-text-primary mb-2">Request Talent</h2>
                                <p class="text-text-secondary">Tell us about your contract or remote placement needs.</p>
                            </div>

                            <form wire:submit="submitRequest" class="space-y-5">
                                <div class="grid grid-cols-2 gap-4">
                                    <x-input wire:model.live.debounce.300ms="first_name" label="First Name*" placeholder="Enter first name" />
                                    <x-input wire:model.live.debounce.300ms="last_name" label="Last Name*" placeholder="Enter last name" />
                                </div>

                                <x-input wire:model.live.debounce.300ms="email" type="email" label="Company Email*"
                                    placeholder="email@company.com" />
                                <x-input wire:model.live.debounce.300ms="phone" label="Phone Number" placeholder="+254 ..." />

                                <x-textarea wire:model.live.debounce.300ms="needs" label="Tell us about your needs"
                                    placeholder="How can we help you?" rows="3" />
                                <x-button type="submit" variant="primary"
                                    class="w-full py-4 text-lg shadow-xl shadow-brand-primary/20"
                                    wire:loading.attr="disabled">
                                    SUBMIT
                                </x-button>

                                <p class="text-[10px] text-text-muted text-center leading-relaxed">
                                    By submitting this form, you agree to our <a href="{{ route('legal.privacy') }}"
                                        wire:navigate class="underline">Privacy Policy</a>. We do not sell or share your
                                    information with third parties.
                                </p>
                            </form>
                        @endif
                    </x-card>
                </div>
            </div>
        </div>

        <!-- Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-[800px] h-[800px] bg-brand-primary/5 rounded-full blur-[150px] opacity-20">
            </div>
            <div
                class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-brand-secondary/5 rounded-full blur-[120px] opacity-10">
            </div>
        </div>
    </section>

    <!-- Core Solutions -->
    <section class="py-12 bg-surface-muted">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-heading align="center" title="Creative Talent for" highlight="Your Professional Needs" class="reveal" />
            <div class="flex flex-wrap justify-center gap-6 my-12">
                @foreach($professionalCategories as $index => $category)
                    @php
                        $representativeTalent = $category->talents->first();
                        $bgImage = $representativeTalent ? $representativeTalent->profile_photo_url : $category->default_image;
                    @endphp
                    <a href="/talent?category={{ $category->slug }}" wire:navigate
                        class="group relative w-full max-w-[280px] aspect-square rounded-3xl overflow-hidden shadow-lg reveal {{ $index % 4 === 1 ? 'reveal-delay-100' : ($index % 4 === 2 ? 'reveal-delay-200' : ($index % 4 === 3 ? 'reveal-delay-300' : '')) }}">
                        <img src="{{ $bgImage }}" alt="{{ $category->name }}"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                            loading="lazy" decoding="async">

                        <div class="absolute inset-0 bg-black/48 group-hover:bg-black/40 transition-colors"></div>

                        <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4">
                            <h3 class="text-xl md:text-2xl font-bold text-white">{{ $category->name }}</h3>
                            <p class="text-brand-primary font-bold text-sm mt-1">{{ $category->talents_count }}
                                Professionals</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Partner Section -->
    <section class="bg-surface-muted/50 overflow-hidden">
        <div class="max-w-7xl mx-auto text-center relative">
            <x-heading level="h2" align="center" class="reveal max-w-3xl mx-auto my-8">
                Scale with professional staffing specialists, so you're always fully optimized.
            </x-heading>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 my-8">
                @php
                    $painPoints = [
                        [
                            'icon' => 'lucide-users',
                            'text' => 'Need specialized talent for a critical project deadline?'
                        ],
                        [
                            'icon' => 'lucide-trending-up',
                            'text' => 'Scaling rapidly and need to fill skill gaps immediately?'
                        ],
                        [
                            'icon' => 'lucide-globe',
                            'text' => 'Looking for top-tier remote talent without the overhead?'
                        ],
                        [
                            'icon' => 'lucide-shield-check',
                            'text' => 'Tired of the risk and time sink of traditional hiring?'
                        ],
                    ];
                @endphp

                @foreach($painPoints as $index => $point)
                    <div
                        class="bg-surface-light border border-subtle p-10 rounded-[3rem] shadow-xl dark:shadow-none flex flex-col items-center justify-center space-y-8 reveal {{ 'reveal-delay-' . ($index * 100) }}">
                        <div
                            class="h-16 w-16 text-brand-primary bg-brand-primary/5 rounded-2xl flex items-center justify-center">
                            <x-dynamic-component :component="$point['icon']" class="w-8 h-8" stroke-width="1.5" />
                        </div>
                        <p class="text-xl font-medium text-text-primary leading-snug">
                            {{ $point['text'] }}
                        </p>
                    </div>
                @endforeach
            </div>

            <div class="flex flex-col sm:flex-row justify-center gap-6 reveal reveal-delay-400 my-8">
                <x-button variant="outline" size="lg" class="px-12 py-5 text-lg" href="/services">
                    Learn More
                </x-button>
                <x-button variant="primary" size="lg" class="px-12 py-5 text-lg shadow-xl shadow-brand-primary/20"
                    href="#request-form">
                    Request a Call
                </x-button>
            </div>

            <!-- Background Decorative Elements -->
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-brand-primary/5 rounded-full blur-3xl -z-10"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-brand-secondary/5 rounded-full blur-3xl -z-10"></div>
        </div>
    </section>

    <!-- Perfect Fit Section -->
    <section class="py-32 bg-surface-dark relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <x-heading level="h2" title="Staff Augmentation? We provide the" highlight="perfect fit." align="center" highlightClass="text-[#65c4af]" class="text-white mb-6" />
            <p class="text-xl text-white/60 mb-20 max-w-3xl mx-auto">
                Cherry-pick professional talent from our curated pool. Hire contract personnel on-demand to scale your business capabilities.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $benefits = [
                        [
                            'title' => 'EFFORTLESS SCALING',
                            'icon' => 'lucide-zap',
                            'desc' => 'Hailerz handles the intensive vetting and recruitment process for you. We provide the specialized talent required for your projects, so you can focus on growth.'
                        ],
                        [
                            'title' => 'CREATIVE TALENT',
                            'icon' => 'lucide-star',
                            'desc' => 'Work with industry-leading professionals who understand high-level professional requirements. Our staffing solutions ensure every role is filled by a professional with a proven track record.'
                        ],
                        [
                            'title' => 'REMOTE READY',
                            'icon' => 'lucide-mouse-pointer-2',
                            'desc' => 'Our talent is primed for immediate integration into your workflows. From project managers to creative directors, we have the resources ready to deliver results.'
                        ],
                    ];
                @endphp

                @foreach($benefits as $index => $benefit)
                    <div
                        class="bg-white/5 backdrop-blur-sm p-10 rounded-3xl border border-white/10 text-left space-y-6 reveal {{ 'reveal-delay-' . ($index * 100) }}">
                        <div class="h-12 w-12 text-brand-primary">
                            <x-dynamic-component :component="$benefit['icon']" class="w-full h-full" stroke-width="2" />
                        </div>
                        <h3 class="text-xl font-bold text-white tracking-wider uppercase">{{ $benefit['title'] }}</h3>
                        <p class="text-white/70 leading-relaxed">
                            {{ $benefit['desc'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Subtle Background Elements -->
        <div
            class="absolute inset-0 opacity-[0.05] bg-[radial-gradient(circle_at_center,var(--color-brand-primary)_1px,transparent_1px)] bg-size-[40px_40px]">
        </div>
    </section>

    <!-- Why Choose Section -->
    <section class="py-32 bg-surface-light relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <x-heading align="center" title="The" highlight="Hailerz Advantage" class="reveal text-text-primary my-8" />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                <div class="flex gap-8 reveal border-b border-subtle pb-8 md:border-none md:pb-0">
                    <div
                        class="h-12 w-12 rounded-full bg-brand-primary/10 text-brand-primary flex items-center justify-center shrink-0">
                        <span class="font-bold">01</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-text-primary mb-4 font-serif">Vetted Skills</h3>
                        <p class="text-text-secondary leading-relaxed font-light">Our personnel are not just candidates; they are proven professionals in their fields, rigorously assessed for both technical skill and professional communication.
                        </p>
                    </div>
                </div>
                <div class="flex gap-8 reveal reveal-delay-100 border-b border-subtle pb-8 md:border-none md:pb-0">
                    <div
                        class="h-12 w-12 rounded-full bg-brand-primary/10 text-brand-primary flex items-center justify-center shrink-0">
                        <span class="font-bold">02</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-text-primary mb-4 font-serif">Strategic Placements</h3>
                        <p class="text-text-secondary leading-relaxed font-light">We don't just fill seats. We understand your business goals and place talent that adds strategic value to your team and projects.</p>
                    </div>
                </div>
                <div class="flex gap-8 reveal reveal-delay-200 border-b border-subtle pb-8 md:border-none md:pb-0">
                    <div
                        class="h-12 w-12 rounded-full bg-brand-primary/10 text-brand-primary flex items-center justify-center shrink-0">
                        <span class="font-bold">03</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-text-primary mb-4 font-serif">Rigorous Vetting</h3>
                        <p class="text-text-secondary leading-relaxed font-light">We don't just review resumes. We
                            conduct multi-stage interviews and practical assessments to ensure every staff member meets
                            our creative talent criteria.</p>
                    </div>
                </div>
                <div class="flex gap-8 reveal reveal-delay-300">
                    <div
                        class="h-12 w-12 rounded-full bg-brand-primary/10 text-brand-primary flex items-center justify-center shrink-0">
                        <span class="font-bold">04</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-text-primary mb-4 font-serif">Rapid Response</h3>
                        <p class="text-text-secondary leading-relaxed font-light">Events are dynamic. We provide a
                            dedicated point of contact and backup personnel protocols to ensure you're never left
                            short-handed.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-40 bg-brand-accent text-center relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 relative z-10 reveal">
            <x-heading level="h2" title="Scale Your" highlight="Professional Team Today." align="center" highlightClass="text-[#65c4af]" class="text-text-inverse mb-8" />
            <p class="text-xl md:text-2xl text-text-inverse/80 mb-12 font-light leading-relaxed">
                From contract specialists to remote creative talent, ensure your projects are powered by creative talent.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <x-button variant="outline" size="lg" href="/services" wire:navigate>
                    Explore Talent Roster
                </x-button>
                <x-button variant="primary" size="lg" href="#request-form">
                    Request Talent Augmentation
                </x-button>
            </div>
        </div>

        <!-- Subtle Grid Background -->
        <div
            class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(var(--color-brand-primary)_1px,transparent_1px)] bg-size-[40px_40px]">
        </div>
    </section>
</div>