<?php

namespace App\Livewire;

use App\Models\Talent;
use Livewire\Component;

class ShowTalent extends Component
{
    public Talent $talent;

    public function mount($slug)
    {
        $this->talent = Talent::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.show-talent')
            ->layout('components.layouts.app', [
                'title' => $this->talent->name . ' | Hailerz Entertainment',
            ]);
    }
}
