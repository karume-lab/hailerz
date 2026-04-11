<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Layout('components.layouts.app')]
#[Title('Join Our Roster | Hailerz')]
class JoinRoster extends Component
{
    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|email|max:255')]
    public $email;

    #[Validate('required|url|max:255')]
    public $portfolio_url;

    #[Validate('required|string|max:1000')]
    public $bio;

    public bool $isSubmitted = false;

    public function submit()
    {
        $this->validate();

        // In a real app, this would save to a Application/Lead model
        // For now, we simulate success
        // Application::create([...]);

        $this->isSubmitted = true;
    }

    public function render()
    {
        return view('livewire.public.join-roster');
    }
}
