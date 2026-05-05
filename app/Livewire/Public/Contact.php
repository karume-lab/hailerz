<?php

namespace App\Livewire\Public;

use Livewire\Component;

class Contact extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $subject;
    public $message;

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ];

    public function submit()
    {
        $this->validate();

        // Here you would typically send an email or dispatch an event
        \Illuminate\Support\Facades\Log::info('Contact form submission', [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        session()->flash('success', 'Your message has been sent successfully. We will get back to you shortly.');

        $this->reset(['first_name', 'last_name', 'email', 'phone', 'subject', 'message']);
    }

    public function render()
    {
        return view('livewire.public.contact');
    }
}
