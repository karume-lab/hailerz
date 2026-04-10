<?php

use App\Models\Talent;
use Livewire\Component;

new class extends Component {
    // 1. The Component State
    public string $category = '';

    // 2. The Data Fetching
    public function with(): array
    {
        return [
            'talents' => Talent::when($this->category, function ($query) {
                $query->where('category', $this->category);
            })->get()
        ];
    }
};
?>

<div class="max-w-7xl mx-auto p-6">

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Browse Talent</h1>

        <select wire:model.live="category" class="border-gray-300 rounded-md shadow-sm px-4 py-2">
            <option value="">All Categories</option>
            <option value="musician">Musicians</option>
            <option value="dj">DJs</option>
            <option value="speaker">Speakers</option>
        </select>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($talents as $talent)
            <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-200">

                <div class="h-48 bg-gray-200 w-full object-cover">
                    @if($talent->headshot_path)
                        <img src="{{ asset('storage/' . $talent->headshot_path) }}" class="h-full w-full object-cover"
                            alt="{{ $talent->name }}">
                    @endif
                </div>

                <div class="p-4">
                    <span class="text-xs font-semibold text-blue-600 uppercase tracking-wider">
                        {{ $talent->category }}
                    </span>
                    <h3 class="mt-1 text-lg font-bold text-gray-900">{{ $talent->name }}</h3>
                    <p class="mt-2 text-sm text-gray-600">Starting at ${{ number_format($talent->min_fee) }}</p>

                    <a href="/talent/{{ $talent->id }}" class="mt-4 block w-full bg-gray-900 text-white py-2 rounded-md hover:bg-gray-800 transition text-center">
                        View Profile
                    </a>
                </div>

            </div>
        @endforeach
    </div>
</div>
