<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.app')]
#[Title('Hailerz | Premium Talent Booking Agency')]
class Home extends Component
{
    // Contact form
    public string $contactName = '';
    public string $contactEmail = '';
    public string $contactMessage = '';
    public bool $contactSent = false;

    protected array $rules = [
        'contactName'    => 'required|string|max:255',
        'contactEmail'   => 'required|email|max:255',
        'contactMessage' => 'required|string|min:10',
    ];

    protected array $messages = [
        'contactName.required'    => 'Please enter your name.',
        'contactEmail.required'   => 'Please enter a valid email address.',
        'contactMessage.required' => 'Please write a message.',
        'contactMessage.min'      => 'Your message should be at least 10 characters.',
    ];

    public function submitContact(): void
    {
        $this->validate();

        // Log the submission; swap for Mail::to() once an email driver is configured
        Log::info('Home contact form submission', [
            'name'    => $this->contactName,
            'email'   => $this->contactEmail,
            'message' => $this->contactMessage,
        ]);

        $this->reset('contactName', 'contactEmail', 'contactMessage');
        $this->contactSent = true;
    }

    public function render()
    {
        return view('livewire.public.home');
    }
}
