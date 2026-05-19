<?php

namespace App\Livewire\Public;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('About Us | Hailerz')]
class About extends Component
{
    public function render()
    {
        return view('livewire.public.about');
    }
}
