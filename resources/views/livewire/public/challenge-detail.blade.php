<div class="w-full min-h-screen bg-surface-light py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        
        <!-- Header Value Display -->
        <div class="mb-8 border-b border-subtle pb-6">
            <a href="/challenges/browse" wire:navigate class="text-xs font-bold text-brand-primary hover:underline uppercase tracking-wider">&larr; Back to Challenges</a>
            <h1 class="text-4xl font-extrabold text-brand-accent mt-4 mb-4 dark:text-text-primary">{{ $challenge->title }}</h1>
            <div class="flex flex-wrap gap-6 text-xs text-text-secondary uppercase tracking-wider font-semibold">
                <span>Timeline Sprint: <strong>{{ $challenge->start_date->format('M d') }} - {{ $challenge->end_date->format('M d, Y') }}</strong></span>
                <span>Reward Pool: <strong class="text-brand-primary">{{ number_format($challenge->prize_pool, 2) }} NGN</strong></span>
            </div>
        </div>

        <!-- Banner image view -->
        @if($challenge->banner_image)
            <div class="w-full aspect-21/9 rounded-4xl overflow-hidden mb-12 border border-subtle">
                <img src="{{ asset('storage/' . $challenge->banner_image) }}" class="w-full h-full object-cover" alt="Banner Image">
            </div>
        @endif

        <!-- Rich Text Render Area -->
        <div class="prose max-w-none text-text-primary mb-12 border-b border-subtle pb-12 leading-relaxed text-sm sm:text-base">
            @if(is_array($challenge->description))
                @foreach($challenge->description as $block)
                    @switch($block['type'])
                        @case('heading')
                            <{{ $block['data']['level'] }} class="font-bold text-brand-accent mt-8 mb-4">{{ $block['data']['content'] }}</{{ $block['data']['level'] }}>
                            @break
                        @case('paragraph')
                            <div class="mb-4">
                                {!! $block['data']['content'] !!}
                            </div>
                            @break
                        @case('image')
                            <div class="my-8 rounded-2xl overflow-hidden border border-subtle">
                                <img src="{{ asset('storage/' . $block['data']['url']) }}" alt="{{ $block['data']['alt'] }}" class="w-full h-auto">
                            </div>
                            @break
                        @case('code')
                            <pre class="bg-surface-dark text-text-inverse p-4 rounded-xl overflow-x-auto my-6 text-sm font-mono leading-normal"><code>{{ $block['data']['code'] }}</code></pre>
                            @break
                    @endswitch
                @endforeach
            @else
                {!! $challenge->description !!}
            @endif
        </div>

        <!-- Action Engine Row -->
        <div class="flex items-center gap-6 mb-12">
            <x-button variant="primary" size="md" href="{{ $challenge->external_url ?? 'https://community.hailerz.com/c/hailerz-challenges/' }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2">
                Participate in Community
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            </x-button>


            <div class="w-auto">
                <x-share-modal :title="$challenge->title" class="w-auto" />
            </div>
        </div>



    </div>
</div>
