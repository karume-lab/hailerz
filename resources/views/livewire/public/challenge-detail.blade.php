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
            <button wire:click="toggleLike" class="flex items-center gap-2 px-6 py-3 rounded-full font-bold text-xs uppercase tracking-wider transition-all border {{ $challenge->interactions->where('user_id', auth()->id())->where('type', 'like')->count() ? 'bg-brand-primary/10 border-brand-primary text-brand-primary' : 'bg-surface-muted/50 border-subtle text-text-secondary hover:border-brand-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $challenge->interactions->where('user_id', auth()->id())->where('type', 'like')->count() ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 {{ $challenge->interactions->where('user_id', auth()->id())->where('type', 'like')->count() ? 'text-brand-primary' : 'text-text-secondary' }}">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
                {{ $challenge->interactions->where('type', 'like')->count() }} Likes
            </button>
            <div class="w-auto">
                <x-share-modal :title="$challenge->title" class="w-auto" />
            </div>
        </div>

        <!-- Comment Tree Section -->
        <div class="space-y-8">
            <h3 class="text-xl font-bold text-brand-accent">Peer Submissions & Discussion ({{ $challenge->comments->count() }})</h3>
            
            @auth
                <div class="space-y-3">
                    <textarea wire:model="newComment" placeholder="Post feedback or paste your submission link here..." rows="4" class="w-full p-4 rounded-2xl border border-subtle focus:border-brand-primary focus:ring-0 bg-surface-muted/10 text-sm" required></textarea>
                    <div class="flex justify-end">
                        <x-button type="button" wire:click="postComment" size="sm">Submit Entry</x-button>
                    </div>
                </div>
            @else
                <p class="text-sm text-text-muted bg-surface-muted p-4 rounded-xl">Please <a href="/sign-in" class="text-brand-primary font-bold hover:underline">sign in</a> to drop a comment or view submission feedback.</p>
            @endauth

            <div class="space-y-4 mt-6">
                @foreach($challenge->comments as $comment)
                    <div class="p-5 bg-surface-muted/30 border border-subtle/40 rounded-3xl">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-xs font-bold text-brand-accent">{{ $comment->user->name }}</span>
                            <span class="text-[10px] text-text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-sm text-text-secondary leading-relaxed">{{ $comment->body }}</p>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
