<?php

namespace App\Livewire\Public\Legal;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Privacy Policy | Hailerz')]
class PrivacyPolicy extends Component
{
    public function render()
    {
        return view('livewire.public.legal.privacy-policy');
    }
}
