<?php

namespace App\Livewire\Public\Legal;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Booking Agreement | Hailerz')]
class BookingAgreement extends Component
{
    public function render()
    {
        return view('livewire.public.legal.booking-agreement');
    }
}
