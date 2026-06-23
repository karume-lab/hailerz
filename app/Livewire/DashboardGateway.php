<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app-workspace')]
class DashboardGateway extends Component
{
    public function render()
    {
        return view('livewire.dashboard-gateway');
    }
}
