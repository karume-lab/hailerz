@props([
    'title' => 'Are you sure?',
    'message' => 'This action cannot be undone.',
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
    'onConfirm' => ''
])

<div x-data="{ open: false }" class="inline-block">
    <div @click="open = true" class="inline-block">
        {{ $slot }}
    </div>

    <!-- Modal Teleport to Body -->
    <template x-teleport="body">
        <div x-show="open" 
             style="display: none;"
             x-on:keydown.escape.window="open = false"
             class="relative z-100">
            
            <!-- Background backdrop -->
            <div x-show="open" 
                 x-transition.opacity.duration.300ms
                 class="fixed inset-0 bg-surface-dark/80 backdrop-blur-sm z-50"></div>

            <!-- Modal panel -->
            <div class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
                <div x-show="open"
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative transform overflow-hidden rounded-2xl bg-surface-light border border-subtle text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg p-8">
                    
                    <div class="sm:flex sm:items-start mb-8">
                        <div class="mx-auto flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <x-lucide-alert-triangle class="h-6 w-6 text-red-600" />
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-xl font-bold leading-6 text-text-primary">
                                {{ $title }}
                            </h3>
                            @if($message)
                                <div class="mt-3">
                                    <p class="text-sm text-text-secondary leading-relaxed">
                                        {{ $message }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse gap-3">
                        <x-button type="button" @click="{{ $onConfirm }}; open = false" class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white border-transparent">
                            {{ $confirmText }}
                        </x-button>
                        <x-button type="button" variant="secondary" @click="open = false" class="w-full sm:w-auto mt-3 sm:mt-0">
                            {{ $cancelText }}
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
