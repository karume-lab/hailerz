<?php

use App\Models\Talent;
use Livewire\Component;

new class extends Component {
    public Talent $talent;

    public function mount($id) {
        $this->talent = Talent::findOrFail($id);
    }
};
?>

<div class="max-w-4xl mx-auto p-6 mt-10">
    <div class="flex flex-col md:flex-row gap-8">
        <div class="w-full md:w-1/3">
            @if($talent->headshot_path)
                <img src="{{ asset('storage/' . $talent->headshot_path) }}" class="rounded-lg shadow-lg w-full">
            @else
                <div class="bg-gray-200 h-64 rounded-lg w-full"></div>
            @endif
        </div>
        <div class="w-full md:w-2/3">
            <span class="text-sm font-bold text-blue-600 uppercase">{{ $talent->category }}</span>
            <h1 class="text-4xl font-bold text-gray-900 mt-1">{{ $talent->name }}</h1>
            <p class="text-xl text-gray-600 mt-2">Starting at ${{ number_format($talent->min_fee) }}</p>
            
            <div class="mt-6 prose">
                {!! $talent->bio !!}
            </div>

            <div class="mt-8">
                <a href="/book" class="bg-gray-900 text-white px-6 py-3 rounded-md font-bold hover:bg-gray-800">Request to Book</a>
            </div>
        </div>
    </div>
</div>
