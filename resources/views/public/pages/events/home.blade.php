<x-layouts.app>
    <x-slot:title>Hailerz Marketplace Expo | Hailerz</x-slot>

        <div class="w-full bg-surface-light min-h-screen">
            <!-- Hero Section -->
            <section class="relative py-24 sm:py-32 overflow-hidden bg-linear-to-b from-brand-primary/5 to-transparent">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="text-center max-w-3xl mx-auto flex flex-col items-center">
                        <x-heading level="h1"
                            title="{{ $event ? explode(' ', $event->title)[0] : 'Where Learning Meets' }}"
                            highlight="{{ $event ? substr($event->title, strpos($event->title, ' ')) : 'Enterprise Innovation' }}"
                            align="center"
                            class="text-brand-accent dark:text-text-primary mb-6 reveal reveal-delay-100" />

                        <div
                            class="text-lg sm:text-xl text-text-secondary mb-10 leading-relaxed reveal reveal-delay-200">
                            @if($event)
                                {!! $event->description !!}
                                <div class="mt-4 font-semibold text-brand-primary flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                    {{ $event->location }} &nbsp;|&nbsp; {{ $event->date->format('F jS, Y') }}
                                </div>
                            @else
                                Join over 1,500 industry leaders, creators, and technology experts at the Hailerz Marketplace Expo. Discover cutting-edge strategies, view state-of-the-art corporate
                                exhibitions, and expand your ecosystem.
                            @endif
                        </div>

                        <div
                            class="flex flex-col sm:flex-row gap-4 justify-center items-center reveal reveal-delay-300">
                            <x-button href="/marketplace-expo/tickets?tier=exhibitor" variant="secondary" size="lg" wire:navigate
                                class="hover:scale-105 transition-transform duration-300">
                                Register Booth
                            </x-button>
                            <x-button href="/marketplace-expo/tickets?tier=attendee" size="lg" wire:navigate
                                class="hover:scale-105 transition-transform duration-300">
                                Get Ticket
                            </x-button>
                        </div>
                        @if($event)
                            <div class="mt-8 flex justify-center reveal reveal-delay-400">
                                <x-share-modal :title="'Check out this event: ' . $event->title" />
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            @if($event && ($event->demographics || $event->universities || $exhibitors->count() > 0))
                <!-- Value Proposition Section -->
                <section class="py-24 bg-surface-light border-t border-subtle relative overflow-hidden">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                        <div class="text-center max-w-3xl mx-auto mb-16 reveal">
                            <x-heading level="h2" title="Why You Should" highlight="Attend" align="center"
                                class="mb-4 text-brand-accent dark:text-text-primary" />
                            <p class="text-text-secondary text-base">
                                A curated ecosystem designed to maximize your ROI, featuring the brightest emerging talents
                                and leading corporate sponsors.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                            @if($event->demographics)
                                <!-- Demographic Pie Chart -->
                                @php
                                    $colors = ['#be123c', '#0f172a', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6'];
                                    $conicStops = [];
                                    $currentPercent = 0;
                                    $colorIndex = 0;
                                    $demographicList = [];
                                    foreach ($event->demographics as $skill => $percent) {
                                        $percentValue = (float) filter_var($percent, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                        $nextPercent = $currentPercent + $percentValue;
                                        $color = $colors[$colorIndex % count($colors)];
                                        $conicStops[] = "{$color} {$currentPercent}% {$nextPercent}%";
                                        $demographicList[] = ['skill' => $skill, 'percent' => $percentValue, 'color' => $color];
                                        $currentPercent = $nextPercent;
                                        $colorIndex++;
                                    }
                                    $gradientString = implode(', ', $conicStops);
                                @endphp
                                <div class="reveal flex flex-col items-center">
                                    <h3 class="text-xl font-bold mb-8 text-brand-accent dark:text-text-primary">Students You'll
                                        Meet</h3>

                                    <div class="w-64 h-64 rounded-full shadow-2xl mb-8 relative"
                                        style="background: conic-gradient({{ $gradientString }});">
                                        <div
                                            class="absolute inset-0 m-auto w-32 h-32 bg-surface-light rounded-full flex items-center justify-center shadow-inner">
                                            <span class="font-bold text-2xl text-text-primary">Talent</span>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 w-full max-w-md">
                                        @foreach($demographicList as $item)
                                            <div class="flex items-center gap-2">
                                                <div class="w-4 h-4 rounded-sm" style="background-color: {{ $item['color'] }}">
                                                </div>
                                                <span class="text-sm font-semibold text-text-secondary">{{ $item['percent'] }}%
                                                    {{ $item['skill'] }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="space-y-12 reveal">
                                @if($event->universities)
                                    <!-- University Logo Grid -->
                                    <div>
                                        <h3 class="text-xl font-bold mb-6 text-brand-accent dark:text-text-primary">Universities
                                            Represented</h3>
                                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-6">
                                            @foreach($event->universities as $uni)
                                                <div
                                                    class="bg-surface-muted border border-subtle p-4 rounded-xl flex flex-col items-center justify-center shadow-sm hover:shadow-md transition-shadow gap-2 text-center h-full overflow-hidden">
                                                    @if(isset($uni['logo']))
                                                        <img src="{{ Storage::url($uni['logo']) }}" alt="{{ $uni['name'] }}"
                                                            class="max-h-10 object-contain grayscale hover:grayscale-0 transition-all">
                                                    @endif
                                                    <span
                                                        class="font-bold text-xs text-text-secondary w-full truncate" title="{{ $uni['name'] }}">{{ $uni['name'] }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if($exhibitors->count() > 0)
                            <!-- Automated Partner Logo Loop -->
                            <div class="mt-24 pt-12 border-t border-subtle text-center">
                                <p class="text-sm font-bold tracking-widest uppercase text-text-muted mb-8">Confirmed Exhibitors
                                    & Partners</p>
                                <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-75">
                                    @foreach($exhibitors as $exhibitor)
                                        @if(Str::startsWith($exhibitor->company_logo, 'data:image'))
                                            <img src="{{ $exhibitor->company_logo }}" alt="{{ $exhibitor->company_name }}"
                                                class="h-12 object-contain grayscale hover:grayscale-0 transition-all duration-300 filter drop-shadow-sm">
                                        @else
                                            <div
                                                class="h-12 px-4 flex items-center justify-center border border-subtle rounded-lg bg-surface-muted grayscale hover:grayscale-0 transition-all font-bold text-text-secondary text-sm">
                                                {{ $exhibitor->company_name }}
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </section>
            @endif

            <!-- Participation Steps Section -->
            <section class="py-24 bg-surface-muted/30 border-y border-subtle">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center max-w-3xl mx-auto mb-16 reveal">
                        <x-heading level="h2" title="How to" highlight="Participate" align="center"
                            class="mb-4 text-brand-accent dark:text-text-primary" />
                        <p class="text-text-secondary text-base">
                            Get involved in the region's premier corporate exhibitor expo and creator conference in
                            three simple steps.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-5xl mx-auto">
                        <!-- Step 1 -->
                        <div class="flex flex-col items-center text-center reveal reveal-delay-100">
                            <div
                                class="w-16 h-16 bg-brand-primary rounded-full flex items-center justify-center text-2xl font-bold text-text-inverse mb-6 shadow-lg shadow-brand-primary/10">
                                01
                            </div>
                            <h3 class="text-xl font-bold mb-3 text-text-primary">Select Pass Tier</h3>
                            <p class="text-text-secondary text-sm leading-relaxed">
                                Choose between a free General Attendee ticket or reserve a custom Corporate Exhibitor
                                Booth space for your brand.
                            </p>
                        </div>

                        <!-- Step 2 -->
                        <div class="flex flex-col items-center text-center reveal reveal-delay-200">
                            <div
                                class="w-16 h-16 bg-brand-primary rounded-full flex items-center justify-center text-2xl font-bold text-text-inverse mb-6 shadow-lg shadow-brand-primary/10">
                                02
                            </div>
                            <h3 class="text-xl font-bold mb-3 text-text-primary">Configure Assets</h3>
                            <p class="text-text-secondary text-sm leading-relaxed">
                                Complete your registration profile and upload your corporate logo/details to be featured
                                across our display channels.
                            </p>
                        </div>

                        <!-- Step 3 -->
                        <div class="flex flex-col items-center text-center reveal reveal-delay-300">
                            <div
                                class="w-16 h-16 bg-brand-primary rounded-full flex items-center justify-center text-2xl font-bold text-text-inverse mb-6 shadow-lg shadow-brand-primary/10">
                                03
                            </div>
                            <h3 class="text-xl font-bold mb-3 text-text-primary">Attend & Connect</h3>
                            <p class="text-text-secondary text-sm leading-relaxed">
                                Receive your PDF access ticket and payment receipt via email, then join 1,500+
                                participants on the expo floor.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Bottom Promotional CTA -->
            <section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="bg-brand-accent rounded-[3rem] p-8 sm:p-16 text-center relative overflow-hidden shadow-xl reveal">
                    <!-- Background Gradients -->
                    <div
                        class="absolute inset-0 bg-linear-to-r from-brand-primary/20 to-transparent pointer-events-none">
                    </div>
                    <div class="relative z-10 max-w-2xl mx-auto flex flex-col items-center">
                        <x-heading level="h2" title="Register for the" highlight="Conference Today" align="center"
                            highlightClass="text-[#65c4af]" class="text-text-inverse mb-4" />
                        <p class="text-text-inverse/85 text-base mb-10 leading-relaxed">
                            Secure your complimentary general admission ticket or reserve a prime exhibitor booth space
                            inside
                            the expo hall. Space is strictly limited.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                            <x-button href="/marketplace-expo/tickets?tier=exhibitor" variant="secondary" size="lg" wire:navigate
                                class="hover:scale-105 transition-transform duration-300">
                                Register Booth
                            </x-button>
                            <x-button href="/marketplace-expo/tickets?tier=attendee" size="lg" wire:navigate
                                class="hover:scale-105 transition-transform duration-300">
                                Get Ticket
                            </x-button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
</x-layouts.app>