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
          <div class="flex items-center justify-between px-4 mb-6">
            <div class="flex items-center gap-3">
              <span class="w-1.5 h-6 bg-primary-500 rounded-full"></span>
              <span class="text-[11px] font-black uppercase tracking-[0.25em] text-gray-950 dark:text-white">
                {{ $status->kanbanTitle() }}
              </span>
            </div>
            <span
              class="inline-flex items-center justify-center min-w-8 h-8 px-2.5 text-[11px] font-black rounded-xl bg-white dark:bg-white/5 text-primary-600 dark:text-primary-400 border border-gray-200 dark:border-white/10 shadow-sm"
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
                class="group relative bg-white/70 dark:bg-gray-900/40 backdrop-blur-xl border border-gray-200/50 dark:border-white/5 p-6 rounded-4xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] dark:shadow-[0_8px_30px_rgb(0,0,0,0.2)] cursor-grab active:cursor-grabbing active:scale-[0.98] hover:border-primary-500/50 hover:bg-white dark:hover:bg-gray-800/60 hover:shadow-[0_20px_50px_rgba(34,55,87,0.15)] dark:hover:shadow-[0_20px_50px_rgba(0,0,0,0.4)] hover:-translate-y-1.5 transition-all duration-500 overflow-hidden block"
              >
                {{-- Brand Accent --}}
                <div class="absolute top-0 left-0 w-full h-1.5 bg-linear-to-r from-primary-600 to-secondary-500 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>

                {{-- Client name & ref --}}
                <div class="mb-6">
                  <div class="text-[17px] font-bold text-gray-950 dark:text-white tracking-tight leading-tight mb-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors" x-text="inquiry.client_name"></div>
                  <div class="flex items-center gap-2.5">
                    <span class="px-2 py-0.5 rounded-md bg-gray-100 dark:bg-white/5 text-[9px] text-gray-500 dark:text-gray-400 font-black uppercase tracking-widest border border-gray-200/50 dark:border-white/5" x-text="'#INQ-' + inquiry.id"></span>
                    <span class="w-1 h-1 bg-gray-300 dark:bg-gray-700 rounded-full"></span>
                    <span class="text-[10px] text-primary-600/80 dark:text-primary-400/80 font-black uppercase tracking-widest" x-text="inquiry.event_type"></span>
                  </div>
                </div>

                {{-- Details Grid --}}
                <div class="pt-6 border-t border-gray-100/50 dark:border-white/5 grid grid-cols-2 gap-x-5 gap-y-4">
                  {{-- Talent --}}
                  <div class="flex items-center gap-2.5 text-[10px] font-bold text-gray-600 dark:text-gray-300">
                    <div class="w-7 h-7 rounded-lg bg-primary-500/10 flex items-center justify-center">
                      <x-filament::icon icon="heroicon-m-star" class="w-4 h-4 text-primary-500" />
                    </div>
                    <span class="truncate" x-text="inquiry.talent_name"></span>
                  </div>

                  {{-- Guests --}}
                  <div class="flex items-center gap-2.5 text-[10px] font-bold text-gray-600 dark:text-gray-300">
                    <div class="w-7 h-7 rounded-lg bg-gray-500/10 flex items-center justify-center">
                      <x-filament::icon icon="heroicon-m-users" class="w-4 h-4 text-gray-400" />
                    </div>
                    <span x-text="inquiry.expected_guests + ' guests'"></span>
                  </div>

                  {{-- Date --}}
                  <div class="flex items-center gap-2.5 text-[10px] font-bold text-gray-600 dark:text-gray-300">
                    <div class="w-7 h-7 rounded-lg bg-secondary-500/10 flex items-center justify-center">
                      <x-filament::icon icon="heroicon-m-calendar" class="w-4 h-4 text-secondary-500" />
                    </div>
                    <span x-text="inquiry.event_date || 'TBD'"></span>
                  </div>

                  {{-- Duration --}}
                  <div class="flex items-center gap-2.5 text-[10px] font-bold text-gray-600 dark:text-gray-300">
                    <div class="w-7 h-7 rounded-lg bg-gray-500/10 flex items-center justify-center">
                      <x-filament::icon icon="heroicon-m-clock" class="w-4 h-4 text-gray-400" />
                    </div>
                    <span x-text="inquiry.duration || 'TBC'"></span>
                  </div>

                  {{-- Location --}}
                  <div class="col-span-2 flex items-center gap-2.5 text-[10px] font-bold text-gray-600 dark:text-gray-300">
                    <div class="w-7 h-7 rounded-lg bg-gray-500/10 flex items-center justify-center">
                      <x-filament::icon icon="heroicon-m-map-pin" class="w-4 h-4 text-gray-400" />
                    </div>
                    <span class="truncate" x-text="inquiry.event_location"></span>
                  </div>

                  {{-- Contact (Compact) --}}
                  <div class="col-span-2 mt-2 pt-4 border-t border-gray-100/50 dark:border-white/5 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                      <div class="group/email transition-transform hover:scale-110">
                        <x-filament::icon icon="heroicon-m-envelope" class="w-4.5 h-4.5 text-gray-400 hover:text-primary-500 transition-colors" />
                      </div>
                      <div class="group/phone transition-transform hover:scale-110">
                        <x-filament::icon icon="heroicon-m-phone" class="w-4.5 h-4.5 text-gray-400 hover:text-primary-500 transition-colors" />
                      </div>
                    </div>
                    
                    <div class="flex items-center gap-2.5">
                      <template x-if="inquiry.budget_flexible">
                        <span class="px-2 py-1 rounded-md bg-amber-500/10 text-amber-600 text-[9px] font-black uppercase tracking-wider border border-amber-500/20">Flexible</span>
                      </template>
                      <div class="px-3.5 py-1.5 rounded-xl bg-gray-950 dark:bg-white text-[11px] font-black text-white dark:text-gray-900 shadow-lg" x-text="inquiry.budget"></div>
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
