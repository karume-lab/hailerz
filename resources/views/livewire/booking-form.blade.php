<?php

use App\Models\Booking;
use Livewire\Component;

new class extends Component {
    public int $step = 1;
    public string $client_name = '';
    public string $event_date = '';
    public bool $is_success = false;

    public function nextStep() {
        $this->validate(['client_name' => 'required', 'event_date' => 'required|date']);
        $this->step = 2;
    }

    public function submit() {
        Booking::create([
            'client_name' => $this->client_name,
            'event_date' => $this->event_date,
            'status' => 'lead'
        ]);
        $this->is_success = true;
    }
};
?>

<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow mt-10 border">
    @if($is_success)
        <div class="text-center py-10">
            <h2 class="text-2xl font-bold text-green-600">Request Sent!</h2>
            <p class="mt-2 text-gray-600">Our agents will review your request and contact you shortly.</p>
        </div>
    @else
        <h2 class="text-2xl font-bold mb-6">Book Talent</h2>
        
        @if($step === 1)
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium">Your Name / Company</label>
                    <input type="text" wire:model="client_name" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    @error('client_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium">Event Date</label>
                    <input type="date" wire:model="event_date" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    @error('event_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <button wire:click="nextStep" class="w-full bg-blue-600 text-white py-2 rounded-md">Continue</button>
            </div>
        @elseif($step === 2)
            <div class="space-y-4">
                <p class="text-gray-600">Review your details before submitting:</p>
                <ul class="list-disc pl-5">
                    <li><strong>Client:</strong> {{ $client_name }}</li>
                    <li><strong>Date:</strong> {{ $event_date }}</li>
                </ul>
                <div class="flex gap-4">
                    <button wire:click="$set('step', 1)" class="w-1/3 bg-gray-200 py-2 rounded-md">Back</button>
                    <button wire:click="submit" class="w-2/3 bg-green-600 text-white py-2 rounded-md">Submit Request</button>
                </div>
            </div>
        @endif
    @endif
</div>
