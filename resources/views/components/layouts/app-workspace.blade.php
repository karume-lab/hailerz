<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Hailerz Workspace' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-white text-text-primary antialiased flex flex-col transition-colors duration-300">

    <!-- Top Navigation Header -->
    <header class="fixed top-0 left-0 right-0 h-16 bg-white border-b border-subtle z-50 flex items-center justify-between px-6">
        <div class="flex items-center gap-4">
            <!-- Brand Logo -->
            <a href="/dashboard" class="flex items-center gap-2" wire:navigate>
                <img src="/images/logo.webp" alt="Hailerz" class="h-8 w-auto object-contain">
                <span class="font-bold text-lg tracking-tight">Hailerz</span>
            </a>
        </div>
        
        <!-- Search Bar -->
        <div class="hidden md:flex flex-1 max-w-md mx-8">
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" class="block w-full pl-10 pr-3 py-2 border border-subtle rounded-full leading-5 bg-surface-muted/50 text-text-primary placeholder-text-muted focus:outline-none focus:bg-white focus:ring-1 focus:ring-brand-primary focus:border-brand-primary sm:text-sm transition-colors" placeholder="Search...">
            </div>
        </div>

        <div class="flex items-center gap-4">
            <!-- User Profile & Status Inline -->
            @livewire('public.workspace-header')
        </div>
    </header>

    <!-- App Sidebar -->
    <aside class="w-64 fixed top-16 left-0 bottom-0 bg-[#f9fafb] border-r border-subtle flex flex-col justify-between z-40 overflow-y-auto">
        <div class="flex flex-col grow p-4 space-y-6">
            
            <!-- Navigation Links Wrapper -->
            <nav class="space-y-6">
                
                <div class="space-y-1">
                    <span class="text-xs font-bold text-text-primary block px-3 mb-2">Community</span>
                    <ul class="space-y-1">
                        <li><a href="/dashboard/whats-new" wire:navigate class="flex px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->is('dashboard/whats-new') ? 'bg-brand-primary text-white' : 'text-text-secondary hover:bg-surface-muted/50' }}">What's New</a></li>
                        <li><a href="/dashboard/introductions" wire:navigate class="flex px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->is('dashboard/introductions') ? 'bg-brand-primary text-white' : 'text-text-secondary hover:bg-surface-muted/50' }}">Introductions</a></li>
                        <li><a href="/dashboard/prompts" wire:navigate class="flex px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->is('dashboard/prompts') ? 'bg-brand-primary text-white' : 'text-text-secondary hover:bg-surface-muted/50' }}">Prompt of the Day</a></li>
                    </ul>
                </div>

                @if(auth()->user()->role === 'getting_talent')
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-text-primary block px-3 mb-2 mt-4">Hire & Manage</span>
                        <ul class="space-y-1">
                            <li><a href="/dashboard/bookings" wire:navigate class="flex px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->is('dashboard/bookings') ? 'bg-brand-primary text-white' : 'text-text-secondary hover:bg-surface-muted/50' }}">Gigs & Active Contracts</a></li>
                            <li><a href="/talent-hub/browse" wire:navigate class="flex px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->is('talent-hub/browse') ? 'bg-brand-primary text-white' : 'text-text-secondary hover:bg-surface-muted/50' }}">Discover Top Creatives</a></li>
                            <li><a href="/dashboard/gig-alerts" wire:navigate class="flex px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->is('dashboard/gig-alerts') ? 'bg-brand-primary text-white' : 'text-text-secondary hover:bg-surface-muted/50' }}">Post a Gig-Alert</a></li>
                            <li><a href="/dashboard/groups" wire:navigate class="flex px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->is('dashboard/groups') ? 'bg-brand-primary text-white' : 'text-text-secondary hover:bg-surface-muted/50' }}">Collaborating Ecosystems</a></li>
                        </ul>
                    </div>
                @endif

                @if(auth()->user()->role === 'actual_talent')
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-text-primary block px-3 mb-2 mt-4">Creator Business</span>
                        <ul class="space-y-1">
                            <li><a href="/dashboard/bookings" wire:navigate class="flex px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->is('dashboard/bookings') ? 'bg-brand-primary text-white' : 'text-text-secondary hover:bg-surface-muted/50' }}">Incoming Bookings</a></li>
                            <li><a href="/dashboard/my-listings" wire:navigate class="flex px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->is('dashboard/my-listings') ? 'bg-brand-primary text-white' : 'text-text-secondary hover:bg-surface-muted/50' }}">Showreel & Rates Setup</a></li>
                            <li><a href="/dashboard/blogs" wire:navigate class="flex px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->is('dashboard/blogs') ? 'bg-brand-primary text-white' : 'text-text-secondary hover:bg-surface-muted/50' }}">My Drafting Canvas</a></li>
                            <li><a href="/dashboard/groups" wire:navigate class="flex px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->is('dashboard/groups') ? 'bg-brand-primary text-white' : 'text-text-secondary hover:bg-surface-muted/50' }}">Professional Boards</a></li>
                        </ul>
                    </div>
                @endif

                @if(auth()->user()->role === 'student_creative' || auth()->user()->role === 'campus_leader')
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-text-primary block px-3 mb-2 mt-4">Campus Network</span>
                        <ul class="space-y-1">
                            <li><a href="/dashboard/campus/hub" wire:navigate class="flex px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->is('dashboard/campus/hub') ? 'bg-brand-primary text-white' : 'text-text-secondary hover:bg-surface-muted/50' }}">My School Hub</a></li>
                            <li><a href="/dashboard/campus/directory" wire:navigate class="flex px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->is('dashboard/campus/directory') ? 'bg-brand-primary text-white' : 'text-text-secondary hover:bg-surface-muted/50' }}">Campus Directory</a></li>
                            <li><a href="/dashboard/campus/leaderboard" wire:navigate class="flex px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->is('dashboard/campus/leaderboard') ? 'bg-brand-primary text-white' : 'text-text-secondary hover:bg-surface-muted/50' }}">University Leaderboard</a></li>
                        </ul>
                    </div>

                    <div class="space-y-1">
                        <span class="text-xs font-bold text-text-primary block px-3 mb-2 mt-4">Learn & Practice</span>
                        <ul class="space-y-1">
                            <li><a href="/challenges/browse" wire:navigate class="flex px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->is('challenges/browse*') ? 'bg-brand-primary text-white' : 'text-text-secondary hover:bg-surface-muted/50' }}">Hailerz Challenges</a></li>
                            <li><a href="/dashboard/academy" wire:navigate class="flex px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->is('dashboard/academy') ? 'bg-brand-primary text-white' : 'text-text-secondary hover:bg-surface-muted/50' }}">Hailerz Academy</a></li>
                            <li><a href="/dashboard/workshops" wire:navigate class="flex px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->is('dashboard/workshops') ? 'bg-brand-primary text-white' : 'text-text-secondary hover:bg-surface-muted/50' }}">Workshops and Events</a></li>
                            <li><a href="/dashboard/groups" wire:navigate class="flex px-3 py-2 text-sm rounded-xl font-medium transition-colors {{ request()->is('dashboard/groups') ? 'bg-brand-primary text-white' : 'text-text-secondary hover:bg-surface-muted/50' }}">Student Groups</a></li>
                        </ul>
                    </div>
                @endif

            </nav>
        </div>

        <!-- Footer Sign-Out Action -->
        <div class="p-4 border-t border-subtle">
            <form method="POST" action="{{ route('logout') }}" class="m-0 w-full">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 text-sm text-brand-crimson font-medium hover:bg-brand-crimson/5 rounded-xl transition-colors">
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    <!-- App Viewport Content Section -->
    <main class="flex-1 pt-16 pl-64 min-h-screen bg-white">
        <div class="p-8">
            {{ $slot }}
        </div>
    </main>

    @livewireScripts
</body>
</html>
