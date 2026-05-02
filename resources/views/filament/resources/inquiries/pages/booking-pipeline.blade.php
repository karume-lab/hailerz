<x-filament-panels::page>
  <style>
    .custom-scrollbar::-webkit-scrollbar {
      width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
      background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
      background: rgba(156, 163, 175, 0.2);
      border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
      background: rgba(156, 163, 175, 0.4);
    }
  </style>
  {{-- View Switcher --}}
  <div class="mb-8 flex justify-start">
    <div class="inline-flex p-1.5 bg-gray-50 dark:bg-white/5 rounded-xl border border-gray-200 dark:border-white/10 shadow-inner">
      <button
        wire:click="toggleView('kanban')"
        @class([
          'flex items-center gap-2.5 px-6 py-2.5 text-[11px] font-black uppercase tracking-[0.15em] rounded-lg transition-all duration-500',
          'bg-white dark:bg-gray-800 shadow-xl text-primary-600 dark:text-primary-400 ring-1 ring-gray-200 dark:ring-white/10' => $activeView === 'kanban',
          'text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400' => $activeView !== 'kanban',
        ])
      >
        <x-filament::icon icon="heroicon-m-view-columns" class="w-4 h-4" />
        Pipeline
      </button>
      <button
        wire:click="toggleView('table')"
        @class([
          'flex items-center gap-2.5 px-6 py-2.5 text-[11px] font-black uppercase tracking-[0.15em] rounded-lg transition-all duration-500',
          'bg-white dark:bg-gray-800 shadow-xl text-primary-600 dark:text-primary-400 ring-1 ring-gray-200 dark:ring-white/10' => $activeView === 'table',
          'text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400' => $activeView !== 'table',
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
      class="flex flex-row gap-8 overflow-x-auto pb-16"
      style="align-items: flex-start; min-height: calc(100vh - 280px);"
    >
      @foreach($this->getStatuses() as $status)
        <div
          class="flex flex-col w-85 shrink-0"
          @dragenter.prevent
          @dragover.prevent
          @drop.prevent="droppedOnStatus('{{ $status->value }}')"
        >
          {{-- Column Header --}}
          <div class="flex items-center justify-between px-3 mb-5">
            <span class="text-[11px] font-black uppercase tracking-[0.2em] text-gray-500 dark:text-gray-400">
              {{ $status->kanbanTitle() }}
            </span>
            <span
              class="inline-flex items-center justify-center min-w-7 h-7 px-2.5 text-[11px] font-black rounded-lg bg-primary-500/10 text-primary-600 dark:text-primary-400 border border-primary-500/20"
              x-text="(inquiries['{{ $status->value }}'] || []).length"
            ></span>
          </div>

          {{-- Cards area --}}
          <div 
            class="flex-1 flex flex-col gap-5 p-4 rounded-3xl border border-gray-200 dark:border-white/10 bg-gray-50/50 dark:bg-white/5 min-h-[450px] max-h-[calc(100vh-320px)] overflow-y-auto shadow-inner transition-colors duration-500 custom-scrollbar"
          >
            <template x-for="inquiry in (inquiries['{{ $status->value }}'] || [])" :key="inquiry.id">
              <a 
                :href="inquiry.edit_url"
                draggable="true"
                @dragstart="startDragging(inquiry.id)"
                class="group relative bg-white dark:bg-gray-900 border border-gray-200 dark:border-white/10 p-6 rounded-2xl shadow-sm cursor-grab active:cursor-grabbing active:scale-[0.98] hover:border-primary-500 hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 overflow-hidden block"
              >
                {{-- Brand Accent --}}
                <div class="absolute top-0 left-0 w-full h-1 bg-primary-600 dark:bg-primary-400 opacity-0 group-hover:opacity-100 transition-opacity"></div>

                {{-- Client name & ref --}}
                <div class="mb-5">
                  <div class="text-[15px] font-bold text-gray-950 dark:text-white tracking-tight leading-tight mb-1" x-text="inquiry.client_name"></div>
                  <div class="flex items-center gap-2">
                    <span class="text-[10px] text-gray-500 dark:text-gray-400 font-black uppercase tracking-widest" x-text="'#INQ-' + inquiry.id"></span>
                    <span class="w-1 h-1 bg-gray-300 dark:bg-gray-700 rounded-full"></span>
                    <span class="text-[10px] text-primary-600 dark:text-primary-400 font-black uppercase tracking-widest" x-text="inquiry.event_type"></span>
                  </div>
                </div>

                {{-- Details --}}
                <div class="pt-5 border-t border-gray-100 dark:border-white/5 flex flex-col gap-3">
                  <div class="flex items-center gap-2.5 text-xs font-semibold text-gray-600 dark:text-gray-400">
                    <div class="w-6 h-6 rounded-lg bg-primary-500/10 flex items-center justify-center">
                      <svg class="w-3.5 h-3.5 text-primary-600 dark:text-primary-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                    </div>
                    <span x-text="inquiry.talent_name"></span>
                  </div>

                  <div class="flex items-center gap-2.5 text-xs font-semibold text-gray-600 dark:text-gray-400">
                    <div class="w-6 h-6 rounded-lg bg-gray-500/10 flex items-center justify-center">
                      <svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" /></svg>
                    </div>
                    <span x-text="inquiry.event_location"></span>
                  </div>

                  <div class="flex items-center justify-between mt-2">
                    <div class="flex items-center gap-2 text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">
                      <svg class="w-3.5 h-3.5 text-secondary-600 dark:text-secondary-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                      <span x-text="inquiry.event_date || 'TBD'"></span>
                    </div>
                    <div class="flex items-center gap-2">
                      <template x-if="inquiry.budget_flexible">
                        <span class="px-1.5 py-0.5 rounded bg-amber-500/10 text-amber-600 text-[8px] font-black uppercase tracking-tighter border border-amber-500/20">Flex</span>
                      </template>
                      <div class="px-2.5 py-1 rounded-lg bg-gray-900 dark:bg-white text-[11px] font-black text-white dark:text-gray-900" x-text="inquiry.budget"></div>
                    </div>
                  </div>
                </div>
              </a>
            </template>

            {{-- Empty drop zone --}}
            <div
              x-show="!(inquiries['{{ $status->value }}'] || []).length"
              class="flex-1 flex items-center justify-center min-h-36 border-2 border-dashed border-gray-200 dark:border-white/10 rounded-3xl bg-gray-50/50 dark:bg-transparent transition-colors"
            >
              <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Drop Lead Here</span>
            </div>
          </div>
        </div>
      @endforeach
    </div>

  {{-- Table View --}}
  @else
    <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-white/10 shadow-2xl overflow-hidden transition-all duration-500">
      {{ $this->table }}
    </div>
  @endif
</x-filament-panels::page>
