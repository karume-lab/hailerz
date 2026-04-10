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
            'artist_name' => 'required',
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

<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow mt-10 border">
    @if($is_success)
        <div class="text-center py-10">
            <h2 class="text-2xl font-bold text-green-600">Application Received!</h2>
            <p class="mt-2 text-gray-600">Our A&R team will review your portfolio and get back to you soon.</p>
        </div>
    @else
        <h2 class="text-2xl font-bold mb-6">Join Our Roster</h2>
        <form wire:submit.prevent="submit" class="space-y-4">
            <div>
                <label class="block text-sm font-medium">Artist / Stage Name</label>
                <input type="text" wire:model="artist_name" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                @error('artist_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Email Address</label>
                <input type="email" wire:model="email" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium">EPK / Portfolio Link (Dropbox, Website, etc.)</label>
                <input type="url" wire:model="epk_link" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                @error('epk_link') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition">
                Submit Application
            </button>
        </form>
    @endif
</div>
