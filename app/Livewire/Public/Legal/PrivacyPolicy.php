<?php

namespace App\Livewire\Public\Legal;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Privacy Policy | Hailerz')]
class PrivacyPolicy extends Component
{
    public function render()
    {
        return view('livewire.public.legal.privacy-policy');
    }
}
