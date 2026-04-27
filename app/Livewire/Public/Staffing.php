<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
#[Title('Event Staffing & Augmentation | Hailerz')]
class Staffing extends Component
{
    public function render()
    {
        return view('livewire.public.staffing');
    }
}
