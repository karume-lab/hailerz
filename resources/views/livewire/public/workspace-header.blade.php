<div class="flex items-center space-x-4">
    <!-- User Profile -->
    <div class="flex items-center space-x-3">
        <div class="text-right hidden sm:block leading-tight">
            <div class="font-bold text-sm text-text-primary">{{ auth()->user()->name }}</div>
            <div class="text-[10px] text-text-muted">{{ auth()->user()->email }}</div>
        </div>
        <div class="w-8 h-8 rounded-full bg-brand-primary text-white flex items-center justify-center font-bold text-xs">
            {{ substr(auth()->user()->name, 0, 1) }}
        </div>
    </div>
</div>
