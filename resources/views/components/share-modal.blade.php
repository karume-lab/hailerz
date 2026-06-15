@props(['title' => 'Check out this page'])

<div class="pt-8 border-t border-subtle " x-data="{ showShareModal: false, copied: false, url: window.location.href }">
    <div class="flex items-center justify-between gap-4">
        <x-button
        @click="showShareModal = true"
        variant="secondary"
        class="w-full">
        Share
        </x-button>
    </div>

    <!-- Share Modal -->
    <div x-show="showShareModal" style="display: none;"
            class="fixed inset-0 z-100 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4 sm:p-6"
            x-transition.opacity
            @keydown.escape.window="showShareModal = false">
            
            <div @click.away="showShareModal = false"
                class="bg-surface-dark text-text-inverse w-full max-w-130 rounded-2xl shadow-sm border border-white/10 flex flex-col "
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95">
                
                <!-- Header -->
                <div class="flex items-center justify-between px-6 pt-5 pb-3">
                    <h3 class="text-[18px] font-medium tracking-wide">Share</h3>
                    <button @click="showShareModal = false" class="text-[#aaaaaa] hover:text-white transition-colors rounded-full p-1.5 hover:bg-white/10">
                        <x-lucide-x class="w-6 h-6" stroke-width="2" />
                    </button>
                </div>

                <!-- Content -->
                <div class="px-6 pb-7">
                    <!-- Share Options List -->
                    <div class="flex overflow-x-auto gap-2 sm:gap-4 pb-4 mb-2 snap-x scrollbar-hide" style="scrollbar-width: none; -ms-overflow-style: none;">
                        <style>
                            .scrollbar-hide::-webkit-scrollbar {
                                display: none;
                            }
                        </style>
                        <!-- Embed -->
                        <div class="flex flex-col items-center gap-2 min-w-19 snap-start">
                            <button @click="navigator.clipboard.writeText(`<iframe src='${url}' width='100%' height='600' frameborder='0'></iframe>`); copied = true; setTimeout(() => copied = false, 2000)" class="w-15 h-15 rounded-full bg-[#3d3d3d] flex items-center justify-center hover:bg-[#4d4d4d] transition-colors group">
                                <x-lucide-code class="w-7 h-7 text-white group-hover:scale-110 transition-transform" stroke-width="1.5" />
                            </button>
                            <span class="text-[13px] text-[#aaaaaa]">Embed</span>
                        </div>
                        
                        <!-- WhatsApp -->
                        <a :href="'https://api.whatsapp.com/send?text=' + encodeURIComponent('{{ addslashes($title) }}: ' + url)" target="_blank" class="flex flex-col items-center gap-2 min-w-19 snap-start group">
                            <button class="w-15 h-15 rounded-full bg-[#25D366] flex items-center justify-center group-hover:opacity-90 transition-opacity">
                                <x-lucide-message-circle class="w-8 h-8 text-white group-hover:scale-110 transition-transform" stroke-width="2" />
                            </button>
                            <span class="text-[13px] text-[#aaaaaa]">WhatsApp</span>
                        </a>

                        <!-- Facebook -->
                        <a :href="'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url)" target="_blank" class="flex flex-col items-center gap-2 min-w-19 snap-start group">
                            <button class="w-15 h-15 rounded-full bg-[#1877F2] flex items-center justify-center group-hover:opacity-90 transition-opacity">
                                <x-lucide-facebook class="w-8 h-8 text-white group-hover:scale-110 transition-transform" stroke-width="2" />
                            </button>
                            <span class="text-[13px] text-[#aaaaaa]">Facebook</span>
                        </a>

                        <!-- X (Twitter) -->
                        <a :href="'https://twitter.com/intent/tweet?url=' + encodeURIComponent(url) + '&text=' + encodeURIComponent('{{ addslashes($title) }}')" target="_blank" class="flex flex-col items-center gap-2 min-w-19 snap-start group">
                            <button class="w-15 h-15 rounded-full bg-black flex items-center justify-center group-hover:bg-gray-900 transition-colors border border-white/10">
                                <x-lucide-twitter class="w-6 h-6 text-white group-hover:scale-110 transition-transform" stroke-width="2" />
                            </button>
                            <span class="text-[13px] text-[#aaaaaa]">X</span>
                        </a>

                        <!-- Email -->
                        <a :href="'mailto:?subject=' + encodeURIComponent('{{ addslashes($title) }}') + '&body=' + encodeURIComponent(url)" class="flex flex-col items-center gap-2 min-w-19 snap-start group">
                            <button class="w-15 h-15 rounded-full bg-[#3d3d3d] flex items-center justify-center group-hover:bg-[#4d4d4d] transition-colors">
                                <x-lucide-mail class="w-7 h-7 text-white group-hover:scale-110 transition-transform" stroke-width="1.5" />
                            </button>
                            <span class="text-[13px] text-[#aaaaaa]">Email</span>
                        </a>
                    </div>

                    <!-- Link Copy Box -->
                    <div class="mt-2 flex flex-col sm:flex-row items-center bg-black rounded-2xl sm:rounded-full border border-white/10 p-1.5 shadow-inner gap-2 sm:gap-0">
                        <x-input 
                            x-model="url" 
                            readonly 
                            class="w-full sm:flex-1 bg-transparent! border-none! text-text-inverse! text-[13px] sm:text-[14px]! py-2! sm:py-2.5! ring-0!" 
                        />
                        <button @click="navigator.clipboard.writeText(url); copied = true; setTimeout(() => copied = false, 2000)" 
                                class="w-full sm:w-auto px-5 py-2 sm:py-2.5 bg-white/10 hover:bg-white/20 text-white text-[13px] sm:text-[14px] font-medium rounded-xl sm:rounded-full transition-colors shrink-0">
                            <span x-text="copied ? 'Copied' : 'Copy'"></span>
                        </button>
                    </div>
                </div>
            </div>
    </div>
</div>
