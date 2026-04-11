<?php

namespace App\Livewire\Public\Legal;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Terms of Service | Hailerz')]
class TermsOfService extends Component
{
    public function render()
    {
        return view('livewire.public.legal.terms-of-service');
    }
}
