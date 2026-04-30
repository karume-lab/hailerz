<x-filament-panels::page>
 {{-- View Switcher --}}
 <div class="mb-8 flex justify-start">
  <div class="inline-flex p-1.5 bg-surface-muted rounded-2xl border border-subtle shadow-inner">
   <button
    wire:click="toggleView('kanban')"
    @class([
     'flex items-center gap-2.5 px-6 py-2.5 text-[11px] font-black uppercase tracking-[0.15em] rounded-xl transition-all duration-500',
     'bg-surface-light shadow-xl text-brand-primary ring-1 ring-subtle' => $activeView === 'kanban',
     'text-text-muted hover:text-brand-primary' => $activeView !== 'kanban',
    ])
   >
    <x-filament::icon icon="heroicon-m-view-columns" class="w-4 h-4" />
    Pipeline
   </button>
   <button
    wire:click="toggleView('table')"
    @class([
     'flex items-center gap-2.5 px-6 py-2.5 text-[11px] font-black uppercase tracking-[0.15em] rounded-xl transition-all duration-500',
     'bg-surface-light shadow-xl text-brand-primary ring-1 ring-subtle' => $activeView === 'table',
     'text-text-muted hover:text-brand-primary' => $activeView !== 'table',
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
      <span class="text-[11px] font-black uppercase tracking-[0.2em] text-text-muted">
       {{ $status->kanbanTitle() }}
      </span>
      <span
       class="inline-flex items-center justify-center min-w-7 h-7 px-2.5 text-[11px] font-black rounded-lg bg-brand-primary/5 text-brand-primary border border-brand-primary/10"
       x-text="(inquiries['{{ $status->value }}'] || []).length"
      ></span>
     </div>

     {{-- Cards area --}}
     <div class="flex-1 flex flex-col gap-5 p-4 rounded-4xl border border-subtle/60 bg-surface-muted/50 /40 min-h-[450px] shadow-inner transition-colors duration-500">
      <template x-for="inquiry in (inquiries['{{ $status->value }}'] || [])" :key="inquiry.id">
       <div
        draggable="true"
        @dragstart="startDragging(inquiry.id)"
        class="group relative bg-surface-light border border-subtle/80 p-6 rounded-3xl shadow-sm cursor-grab active:cursor-grabbing active:scale-[0.98] hover:border-brand-primary hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 overflow-hidden"
       >
        {{-- Brand Accent --}}
        <div class="absolute top-0 left-0 w-full h-1 bg-brand-primary opacity-0 group-hover:opacity-100 transition-opacity"></div>

        {{-- Edit button, revealed on hover --}}
        <div class="absolute top-5 right-5 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-2 group-hover:translate-x-0">
         <a :href="inquiry.edit_url" class="flex items-center justify-center w-8 h-8 rounded-full bg-surface-muted text-text-muted hover:text-brand-primary transition-colors shadow-sm">
          <x-filament::icon icon="heroicon-m-pencil-square" class="w-4 h-4" />
         </a>
        </div>

        {{-- Client name & ref --}}
        <div class="mb-5">
         <div class="text-[15px] font-bold text-text-primary tracking-tight leading-tight mb-1" x-text="inquiry.client_name"></div>
         <span class="text-[10px] text-text-muted font-black uppercase tracking-widest" x-text="'#INQ-' + inquiry.id"></span>
        </div>

        {{-- Details --}}
        <div class="pt-5 border-t border-subtle /50 flex flex-col gap-3">
         <div class="flex items-center gap-2.5 text-xs font-semibold text-text-secondary">
          <div class="w-6 h-6 rounded-lg bg-brand-primary/5 flex items-center justify-center">
           <svg class="w-3.5 h-3.5 text-brand-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
          </div>
          <span x-text="inquiry.talent_name"></span>
         </div>

          <div class="flex items-center justify-between mt-2">
           <div class="flex items-center gap-2 text-[10px] font-bold text-text-muted uppercase tracking-widest">
            <svg class="w-3.5 h-3.5 text-brand-secondary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
            <span x-text="inquiry.event_date || 'TBD'"></span>
           </div>
           <div class="px-2.5 py-1 rounded-lg bg-surface-dark text-[11px] font-black text-text-inverse" x-text="inquiry.budget"></div>
          </div>
        </div>
       </div>
      </template>

      {{-- Empty drop zone --}}
      <div
       x-show="!(inquiries['{{ $status->value }}'] || []).length"
       class="flex-1 flex items-center justify-center min-h-36 border-2 border-dashed border-subtle rounded-4xl bg-surface-muted/50 dark:bg-transparent transition-colors"
      >
       <span class="text-[10px] font-black text-text-muted uppercase tracking-[0.2em]">Drop Lead Here</span>
      </div>
     </div>
    </div>
   @endforeach
  </div>

 {{-- Table View --}}
 @else
  <div class="bg-surface-light rounded-4xl border border-subtle shadow-2xl overflow-hidden transition-all duration-500">
   {{ $this->table }}
  </div>
 @endif
</x-filament-panels::page>
