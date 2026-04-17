<?php

namespace App\Livewire\Public;

use Livewire\Component;

class Contact extends Component
{
    public $name;
    public $email;
    public $subject;
    public $message;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ];

    public function submit()
    {
        $this->validate();

        // Here you would typically send an email or dispatch an event

        session()->flash('success', 'Your message has been sent successfully. We will get back to you shortly.');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.public.contact');
    }
}
