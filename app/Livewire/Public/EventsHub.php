<?php

namespace App\Livewire\Public;

use App\Models\EventRegistration;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Hailerz | Event & Conference Expo')]
class EventsHub extends Component
{
    public function render()
    {
        $exhibitors = EventRegistration::where('pass_type', 'exhibitor')
            ->where('payment_status', 'confirmed')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.public.events-hub', [
            'exhibitors' => $exhibitors,
        ]);
    }
}
