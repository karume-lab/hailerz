@props([
    'activeTrack' => null
])

<div x-data="{ activeMenu: null }" @mouseleave="activeMenu = null" class="hidden lg:flex items-center space-x-8 h-full">
    <!-- Links wrapper to handle hover triggering -->
    <div class="flex space-x-8 h-full items-center">
        <!-- 1. About Track -->
        <div class="relative h-full flex items-center" @mouseenter="activeMenu = 'about'">
            <a href="/about" wire:navigate class="text-sm font-semibold tracking-wide transition-colors" :class="activeMenu === 'about' || (!activeMenu && '{{ request()->is('about*') }}') ? 'text-brand-primary' : 'text-text-secondary hover:text-brand-primary'">
                About
            </a>
        </div>

        <!-- 3. Marketplace Track -->
        <div class="relative h-full flex items-center" @mouseenter="activeMenu = 'marketplace'">
            <a href="/marketplace" wire:navigate class="text-sm font-semibold tracking-wide transition-colors" :class="activeMenu === 'marketplace' || (!activeMenu && '{{ request()->is('marketplace*') }}') ? 'text-brand-primary' : 'text-text-secondary hover:text-brand-primary'">
                Marketplace
            </a>
        </div>

        <!-- 4. Learn Track -->
        <div class="relative h-full flex items-center" @mouseenter="activeMenu = 'learn'">
            <a href="/learn" wire:navigate class="text-sm font-semibold tracking-wide transition-colors" :class="activeMenu === 'learn' || (!activeMenu && '{{ request()->is('learn*') }}') ? 'text-brand-primary' : 'text-text-secondary hover:text-brand-primary'">
                Learn
            </a>
        </div>

        <!-- 5. Connect Track -->
        <div class="relative h-full flex items-center" @mouseenter="activeMenu = 'connect'">
            <a href="/connect" wire:navigate class="text-sm font-semibold tracking-wide transition-colors" :class="activeMenu === 'connect' || (!activeMenu && '{{ request()->is('connect*') }}') ? 'text-brand-primary' : 'text-text-secondary hover:text-brand-primary'">
                Connect
            </a>
        </div>

        <!-- 6. Events Track -->
        <div class="relative h-full flex items-center" @mouseenter="activeMenu = 'events'">
            <a href="/events" wire:navigate class="text-sm font-semibold tracking-wide transition-colors" :class="activeMenu === 'events' || (!activeMenu && '{{ request()->is('events*') }}') ? 'text-brand-primary' : 'text-text-secondary hover:text-brand-primary'">
                Events
            </a>
        </div>

        <!-- Direct Links -->
        <div class="relative h-full flex items-center" @mouseenter="activeMenu = 'contact'">
            <a href="/contact" wire:navigate class="text-sm font-semibold tracking-wide transition-colors" :class="activeMenu === 'contact' || (!activeMenu && '{{ request()->is('contact*') }}') ? 'text-brand-primary' : 'text-text-secondary hover:text-brand-primary'">
                Contact
            </a>
        </div>
    </div>

    <!-- Mega Dropdown Wrapper (Absolute positioned under header) -->
    <div 
        class="absolute left-0 top-20 w-full bg-surface-light border-t border-b border-subtle shadow-xl overflow-hidden transition-all duration-300 ease-in-out z-40"
        :class="(activeMenu && activeMenu !== 'contact') ? 'opacity-100 pointer-events-auto max-h-125' : 'opacity-0 pointer-events-none max-h-0'"
        x-cloak
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <!-- 1. About Panel -->
            <div x-show="activeMenu === 'about'" class="grid grid-cols-10 gap-12" style="display: none;">
                <div class="col-span-4 pr-8 border-r border-subtle flex flex-col justify-center">
                    <h2 class="text-3xl text-brand-primary mb-4">About Hailerz</h2>
                    <p class="text-text-secondary text-base leading-relaxed">Discover our vision, meet the team, and learn how we empower the global creator economy.</p>
                </div>
                
                <div class="col-span-6">
                    <h3 class="text-xs text-brand-primary tracking-widest uppercase mb-6">Company Information</h3>
                    <ul class="space-y-4">
                        <li><a href="/about#story" class="text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">Our Story</a></li>
                        <li><a href="/about#team" class="text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">Meet Our Team</a></li>
                        <li><a href="/about#what-sets-us-apart" class="text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">What Sets Us Apart</a></li>
                    </ul>
                </div>
            </div>

            <!-- 3. Marketplace Panel -->
            <div x-show="activeMenu === 'marketplace'" class="grid grid-cols-10 gap-12" style="display: none;">
                <div class="col-span-4 pr-8 border-r border-subtle flex flex-col justify-center">
                    <h2 class="text-3xl text-brand-primary mb-4">Content Marketplace</h2>
                    <p class="text-text-secondary text-base leading-relaxed">Source verified on-demand deliverables and manage collaborative creative contracts.</p>
                </div>
                
                <div class="col-span-6">
                    <h3 class="text-xs text-brand-primary tracking-widest uppercase mb-6">Booking Options</h3>
                    <ul class="space-y-4">
                        <li><a href="/marketplace/services" class="text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">Services</a></li>
                        <li><a href="/marketplace/browse" class="text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">Browse Talent</a></li>
                        <li><a href="/marketplace/submissions" class="text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">Submissions</a></li>
                    </ul>
                </div>
            </div>

            <!-- 4. Learn Panel -->
            <div x-show="activeMenu === 'learn'" class="grid grid-cols-10 gap-12" style="display: none;">
                <div class="col-span-4 pr-8 border-r border-subtle flex flex-col justify-center">
                    <h2 class="text-3xl text-brand-primary mb-4">Skill Acceleration</h2>
                    <p class="text-text-secondary text-base leading-relaxed">Elevate your craft, unlock technical masterclasses, and compete in global sprints.</p>
                </div>
                
                <div class="col-span-6">
                    <h3 class="text-xs text-brand-primary tracking-widest uppercase mb-6">Academy Programs</h3>
                    <ul class="space-y-4">
                        <li><a href="/academy" class="text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">Hailerz Academy</a></li>
                        <li><a href="/resources" class="text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">Resources</a></li>
                        <li><a href="/challenges" class="text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">Hailerz Challenges</a></li>
                    </ul>
                </div>
            </div>

            <!-- 5. Connect Panel -->
            <div x-show="activeMenu === 'connect'" class="grid grid-cols-10 gap-12" style="display: none;">
                <div class="col-span-4 pr-8 border-r border-subtle flex flex-col justify-center">
                    <h2 class="text-3xl text-brand-primary mb-4">Community Hub</h2>
                    <p class="text-text-secondary text-base leading-relaxed">Deepen local ecosystem retention and connect with hyper-localized creator groups.</p>
                </div>
                
                <div class="col-span-6">
                    <h3 class="text-xs text-brand-primary tracking-widest uppercase mb-6">Networking</h3>
                    <ul class="space-y-4">
                        <li><a href="/connect/meetups" class="text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">Meetups</a></li>
                        <li><a href="/connect/students" class="text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">Student Communities</a></li>
                        <li><a href="/connect/groups" class="text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">Groups</a></li>
                    </ul>
                </div>
            </div>

            <!-- 6. Events Panel -->
            <div x-show="activeMenu === 'events'" class="grid grid-cols-10 gap-12" style="display: none;">
                <div class="col-span-4 pr-8 border-r border-subtle flex flex-col justify-center">
                    <h2 class="text-3xl text-brand-primary mb-4">Events & Conference</h2>
                    <p class="text-text-secondary text-base leading-relaxed">Join the Hailerz Event & Conference Expo, displaying cutting-edge corporate exhibitor spaces and connecting ecosystem participants.</p>
                </div>
                
                <div class="col-span-6">
                    <h3 class="text-xs text-brand-primary tracking-widest uppercase mb-6">Event Options</h3>
                    <ul class="space-y-4">
                        <li><a href="/events/services" class="text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">Services</a></li>
                        <li><a href="/events/browse" class="text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">Browse Events</a></li>
                        <li><a href="/events/tickets" class="text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">Get Tickets</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
