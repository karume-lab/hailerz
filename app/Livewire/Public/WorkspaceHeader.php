<?php

namespace App\Livewire\Public;

use Livewire\Component;

class WorkspaceHeader extends Component
{
    public string $availabilityStatus;

    public function mount()
    {
        $this->availabilityStatus = auth()->user()->availability_status ?? 'Available';
    }

    public function updatedAvailabilityStatus($value)
    {
        $this->validate([
            'availabilityStatus' => 'required|in:Available,Collaborating,Busy',
        ]);

        auth()->user()->update([
            'availability_status' => $value,
        ]);

        session()->flash('status_updated', 'Status updated cleanly.');
    }

    public function render()
    {
        return view('livewire.public.workspace-header');
    }
}
