<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
#[Title('Hailerz | Premium Talent Booking Agency')]
class Home extends Component
{
    public function render()
    {
        return view('livewire.public.home');
    }
}
