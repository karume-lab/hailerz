<x-filament-panels::page>
    {{-- View Switcher --}}
    <div class="mb-6 flex justify-start">
        <div class="inline-flex p-1 bg-canvas dark:bg-dark rounded-lg border border-dark/10 shadow-sm">
            <button
                wire:click="toggleView('kanban')"
                @class([
                    'flex items-center gap-2 px-4 py-1.5 text-xs font-bold rounded-md transition-all duration-200',
                    'bg-surface dark:bg-dark-muted shadow text-primary dark:text-primary-400' => $activeView === 'kanban',
                    'text-gray-500 hover:text-dark-muted dark:hover:text-gray-300' => $activeView !== 'kanban',
                ])
            >
                <x-filament::icon icon="heroicon-m-view-columns" class="w-4 h-4" />
                Pipeline
            </button>
            <button
                wire:click="toggleView('table')"
                @class([
                    'flex items-center gap-2 px-4 py-1.5 text-xs font-bold rounded-md transition-all duration-200',
                    'bg-surface dark:bg-dark-muted shadow text-primary dark:text-primary-400' => $activeView === 'table',
                    'text-gray-500 hover:text-dark-muted dark:hover:text-gray-300' => $activeView !== 'table',
                ])
            >
                <x-filament::icon icon="heroicon-m-table-cells" class="w-4 h-4" />
                Table View
            </button>
        </div>
    </div>

    {{-- Kanban Board --}}
    @if($activeView === 'kanban')
        <div
            x-data="{
                inquiries: @entangle('inquiries'),
                draggingRecord: null,
                startDragging(id) { this.draggingRecord = id; },
                droppedOnStatus(statusValue) {
                    if (!this.draggingRecord) return;
                    $wire.moveCard(this.draggingRecord, statusValue);
                    this.draggingRecord = null;
                }
            }"
            class="flex flex-row gap-5 overflow-x-auto pb-12"
            style="align-items: flex-start; min-height: calc(100vh - 260px);"
        >
            @foreach($this->getStatuses() as $status)
                <div
                    class="flex flex-col w-72 shrink-0"
                    @dragenter.prevent
                    @dragover.prevent
                    @drop.prevent="droppedOnStatus('{{ $status->value }}')"
                >
                    {{-- Column Header --}}
                    <div class="flex items-center gap-2 px-1 mb-3">
                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-600">
                            {{ $status->kanbanTitle() }}
                        </span>
                        <span
                            class="inline-flex items-center justify-center min-w-5 h-5 px-1.5 text-[10px] font-bold rounded-full bg-canvas dark:bg-dark-muted text-gray-500 dark:text-gray-400 border border-dark/10"
                            x-text="(inquiries['{{ $status->value }}'] || []).length"
                        ></span>
                    </div>

                    {{-- Cards area --}}
                    <div class="flex-1 flex flex-col gap-2.5 p-2 rounded-2xl border border-dark/5 dark:border-dark-muted bg-canvas/50 dark:bg-dark/30 min-h-[350px]">
                        <template x-for="inquiry in (inquiries['{{ $status->value }}'] || [])" :key="inquiry.id">
                            <div
                                draggable="true"
                                @dragstart="startDragging(inquiry.id)"
                                class="group relative bg-surface dark:bg-dark-muted border border-dark/10 dark:border-dark p-4 rounded-xl shadow-sm cursor-grab active:cursor-grabbing active:scale-[0.97] hover:border-primary dark:hover:border-primary hover:shadow-md transition-all duration-150"
                            >
                                {{-- Edit button, revealed on hover --}}
                                <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-150">
                                    <a :href="inquiry.edit_url" class="text-gray-400 hover:text-primary-500 transition-colors">
                                        <x-filament::icon icon="heroicon-m-pencil-square" class="w-4 h-4" />
                                    </a>
                                </div>

                                {{-- Client name & ref --}}
                                <div class="mb-3">
                                    <div class="text-sm font-bold text-gray-900 dark:text-white" x-text="inquiry.client_name"></div>
                                    <span class="text-[10px] text-gray-400 uppercase tracking-tight" x-text="'#INQ-' + inquiry.id"></span>
                                </div>

                                {{-- Details --}}
                                <div class="pt-2.5 border-t border-gray-100 dark:border-gray-800/50 flex flex-col gap-1.5">
                                    <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                        <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                                        <span x-text="inquiry.talent_name"></span>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-1.5 text-[11px] text-gray-400">
                                            <svg class="w-3.5 h-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                                            <span x-text="inquiry.event_date || 'TBD'"></span>
                                        </div>
                                        <span class="text-[11px] font-black text-gray-900 dark:text-white" x-text="inquiry.budget"></span>
                                    </div>
                                </div>
                            </div>
                        </template>

                        {{-- Empty drop zone --}}
                        <div
                            x-show="!(inquiries['{{ $status->value }}'] || []).length"
                            class="flex-1 flex items-center justify-center min-h-24 border-2 border-dashed border-gray-200 dark:border-gray-800/50 rounded-xl"
                        >
                            <span class="text-[10px] font-bold text-gray-300 dark:text-gray-700 uppercase tracking-widest">Drop here</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    {{-- Table View --}}
    @else
        {{ $this->table }}
    @endif
</x-filament-panels::page>
