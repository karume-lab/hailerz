<?php

use App\Models\Submission;
use Livewire\Component;

new class extends Component {
    public string $artist_name = '';
    public string $email = '';
    public string $epk_link = '';
    public bool $is_success = false;

    public function submit() {
        $this->validate([
            'artist_name' => 'required|min:2',
            'email' => 'required|email',
            'epk_link' => 'required|url',
        ]);

        Submission::create([
            'artist_name' => $this->artist_name,
            'email' => $this->email,
            'epk_link' => $this->epk_link,
            'status' => 'pending'
        ]);

        $this->is_success = true;
    }
};
?>

<div class="max-w-2xl mx-auto p-12 bg-white rounded-[2.5rem] shadow-2xl border border-brand-navy/5 mt-10">
    @if($is_success)
        <div class="text-center py-12">
            <div class="w-20 h-20 bg-brand-teal/10 text-brand-teal rounded-full flex items-center justify-center mx-auto mb-8">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h2 class="text-3xl font-bold text-brand-navy font-serif mb-4 tracking-tight">Roster Application Received</h2>
            <p class="text-text-secondary leading-relaxed font-light mb-8">Our A&R and procurement team will audit your professional portfolio and technical riders. Successful applicants will be contacted for further vetting.</p>
            <x-button variant="secondary" href="/">Return to Agency Home</x-button>
        </div>
    @else
        <div class="flex items-center gap-3 mb-4">
            <span class="h-px w-8 bg-brand-teal"></span>
            <span class="text-xs font-bold text-brand-teal uppercase tracking-widest">A&R Procurement</span>
        </div>
        <h2 class="text-3xl font-bold text-brand-navy font-serif mb-10 tracking-tight">Roster Application</h2>
        
        <form wire:submit.prevent="submit" class="space-y-8">
            <div>
                <label class="block text-xs font-bold text-brand-navy uppercase tracking-widest mb-3">Professional Identity / Stage Name</label>
                <input type="text" wire:model="artist_name" placeholder="Official act name" class="w-full bg-surface-muted border border-brand-navy/10 rounded-xl px-5 py-4 text-brand-navy focus:ring-2 focus:ring-brand-teal focus:border-transparent outline-none transition-all placeholder:text-text-muted">
                @error('artist_name') <span class="text-red-500 text-[10px] font-bold uppercase mt-2 block">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label class="block text-xs font-bold text-brand-navy uppercase tracking-widest mb-3">Professional Email Address</label>
                <input type="email" wire:model="email" placeholder="contact@talent.com" class="w-full bg-surface-muted border border-brand-navy/10 rounded-xl px-5 py-4 text-brand-navy focus:ring-2 focus:ring-brand-teal focus:border-transparent outline-none transition-all placeholder:text-text-muted">
                @error('email') <span class="text-red-500 text-[10px] font-bold uppercase mt-2 block">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label class="block text-xs font-bold text-brand-navy uppercase tracking-widest mb-3">EPK / Technical Portfolio Link</label>
                <input type="url" wire:model="epk_link" placeholder="https://dropbox.com/sh/..." class="w-full bg-surface-muted border border-brand-navy/10 rounded-xl px-5 py-4 text-brand-navy focus:ring-2 focus:ring-brand-teal focus:border-transparent outline-none transition-all placeholder:text-text-muted">
                <p class="mt-2 text-[10px] text-text-muted font-medium italic">Please provide a direct link to your electronic press kit or live performance portfolio.</p>
                @error('epk_link') <span class="text-red-500 text-[10px] font-bold uppercase mt-2 block">{{ $message }}</span> @enderror
            </div>
            
            <div class="pt-4">
                <x-button type="submit" variant="primary" size="lg" class="w-full">
                    Submit Professional Application
                </x-button>
            </div>
        </form>
    @endif
</div>
