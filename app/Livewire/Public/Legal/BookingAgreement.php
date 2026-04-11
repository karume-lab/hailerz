<?php

namespace App\Livewire\Public\Legal;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Booking Agreement | Hailerz')]
class BookingAgreement extends Component
{
    public function render()
    {
        return view('livewire.public.legal.booking-agreement');
    }
}
