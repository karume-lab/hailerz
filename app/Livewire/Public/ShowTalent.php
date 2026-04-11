<?php

namespace App\Livewire\Public;

use App\Models\Talent;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class ShowTalent extends Component
{
    public Talent $talent;

    public function mount(string $slug)
    {
        $this->talent = Talent::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.public.show-talent')
            ->title('Book ' . $this->talent->name . ' | Hailerz');
    }
}
