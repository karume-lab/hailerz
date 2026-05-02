<?php

namespace App\Livewire\Public;

use App\Models\ContentResource;
use Livewire\Component;
use Livewire\WithPagination;

class Resources extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.public.resources', [
            'resources' => ContentResource::where('is_published', true)
                ->latest()
                ->paginate(12),
        ])->layout('components.layouts.app');
    }
}
