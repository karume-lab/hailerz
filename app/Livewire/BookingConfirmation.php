<?php

namespace App\Livewire;

use Livewire\Component;

class BookingConfirmation extends Component
{
    public function render()
    {
        return view('livewire.booking-confirmation')->layout('components.layouts.app');
    }
}
