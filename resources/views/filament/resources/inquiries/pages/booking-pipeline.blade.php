<x-filament-panels::page>
    {{-- View Switcher --}}
    <div class="mb-6 flex justify-start">
        <div class="inline-flex p-1 bg-surface-muted dark:bg-surface-dark rounded-xl border border-brand-navy/10 shadow-sm">
            <button
                wire:click="toggleView('kanban')"
                @class([
                    'flex items-center gap-2 px-5 py-2 text-[10px] font-black uppercase tracking-widest rounded-lg transition-all duration-300',
                    'bg-white dark:bg-brand-navy shadow-lg text-brand-teal' => $activeView === 'kanban',
                    'text-text-muted hover:text-brand-teal' => $activeView !== 'kanban',
                ])
            >
                <x-filament::icon icon="heroicon-m-view-columns" class="w-4 h-4" />
                Pipeline
            </button>
            <button
                wire:click="toggleView('table')"
                @class([
                    'flex items-center gap-2 px-5 py-2 text-[10px] font-black uppercase tracking-widest rounded-lg transition-all duration-300',
                    'bg-white dark:bg-brand-navy shadow-lg text-brand-teal' => $activeView === 'table',
                    'text-text-muted hover:text-brand-teal' => $activeView !== 'table',
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
            class="flex flex-row gap-6 overflow-x-auto pb-12"
            style="align-items: flex-start; min-height: calc(100vh - 260px);"
        >
            @foreach($this->getStatuses() as $status)
                <div
                    class="flex flex-col w-80 shrink-0"
                    @dragenter.prevent
                    @dragover.prevent
                    @drop.prevent="droppedOnStatus('{{ $status->value }}')"
                >
                    {{-- Column Header --}}
                    <div class="flex items-center justify-between px-2 mb-4">
                        <span class="text-[10px] font-black uppercase tracking-widest text-brand-navy/40 dark:text-text-muted">
                            {{ $status->kanbanTitle() }}
                        </span>
                        <span
                            class="inline-flex items-center justify-center min-w-6 h-6 px-2 text-[10px] font-black rounded-full bg-brand-teal/10 text-brand-teal border border-brand-teal/20"
                            x-text="(inquiries['{{ $status->value }}'] || []).length"
                        ></span>
                    </div>

                    {{-- Cards area --}}
                    <div class="flex-1 flex flex-col gap-4 p-3 rounded-4xl border border-brand-navy/5 bg-surface-muted/50 dark:bg-surface-dark/50 min-h-[400px]">
                        <template x-for="inquiry in (inquiries['{{ $status->value }}'] || [])" :key="inquiry.id">
                            <div
                                draggable="true"
                                @dragstart="startDragging(inquiry.id)"
                                class="group relative bg-white dark:bg-brand-navy border border-brand-navy/5 p-5 rounded-2xl shadow-sm cursor-grab active:cursor-grabbing active:scale-[0.98] hover:border-brand-teal hover:shadow-xl transition-all duration-300"
                            >
                                {{-- Edit button, revealed on hover --}}
                                <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <a :href="inquiry.edit_url" class="text-text-muted hover:text-brand-teal transition-colors">
                                        <x-filament::icon icon="heroicon-m-pencil-square" class="w-4 h-4" />
                                    </a>
                                </div>

                                {{-- Client name & ref --}}
                                <div class="mb-4">
                                    <div class="text-sm font-bold text-brand-navy dark:text-white" x-text="inquiry.client_name"></div>
                                    <span class="text-[10px] text-text-muted font-bold uppercase tracking-tight" x-text="'#INQ-' + inquiry.id"></span>
                                </div>

                                {{-- Details --}}
                                <div class="pt-4 border-t border-brand-navy/5 flex flex-col gap-2">
                                    <div class="flex items-center gap-2 text-[11px] font-medium text-text-secondary">
                                        <svg class="w-3.5 h-3.5 text-brand-teal shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                                        <span x-text="inquiry.talent_name"></span>
                                    </div>

                                    <div class="flex items-center justify-between mt-2">
                                        <div class="flex items-center gap-1.5 text-[10px] font-bold text-text-muted uppercase tracking-widest">
                                            <svg class="w-3.5 h-3.5 shrink-0 text-brand-mint" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                                            <span x-text="inquiry.event_date || 'TBD'"></span>
                                        </div>
                                        <span class="text-xs font-black text-brand-navy dark:text-white" x-text="inquiry.budget"></span>
                                    </div>
                                </div>
                            </div>
                        </template>

                        {{-- Empty drop zone --}}
                        <div
                            x-show="!(inquiries['{{ $status->value }}'] || []).length"
                            class="flex-1 flex items-center justify-center min-h-32 border-2 border-dashed border-brand-navy/10 rounded-2xl"
                        >
                            <span class="text-[10px] font-black text-brand-navy/20 uppercase tracking-widest">Drop specifications here</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    {{-- Table View --}}
    @else
        <div class="bg-white dark:bg-brand-navy rounded-4xl border border-brand-navy/5 shadow-xl overflow-hidden">
            {{ $this->table }}
        </div>
    @endif
</x-filament-panels::page>
