<?php

namespace App\Livewire;

use App\Models\Inquiry;
use App\Models\Talent;
use App\Enums\InquiryStatus;
use Livewire\Component;

class BookingWizard extends Component
{
    public $step = 1;
    public $totalSteps = 3;

    // Form Data
    public $talent_id = null;
    public $event_date = '';
    public $event_type = '';
    public $budget = '';
    public $location = '';
    public $client_name = '';
    public $client_email = '';
    public $message = '';

    public function mount()
    {
        $this->talent_id = request()->query('talent');
    }

    public function nextStep()
    {
        $this->validate(match($this->step) {
            1 => [
                'event_date' => 'required|date|after_or_equal:today',
                'event_type' => 'required',
            ],
            2 => [
                'budget' => 'nullable|numeric',
                'location' => 'required',
            ],
            default => [],
        });

        $this->step++;
    }

    public function prevStep()
    {
        $this->step--;
    }

    public function submit()
    {
        $this->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'message' => 'required|string|min:20',
        ]);

        Inquiry::create([
            'talent_id' => $this->talent_id ?: null,
            'client_name' => $this->client_name,
            'client_email' => $this->client_email,
            'event_date' => $this->event_date,
            'event_type' => $this->event_type,
            'budget' => $this->budget ?: null,
            'message' => $this->message,
            'status' => InquiryStatus::New,
        ]);

        return redirect()->to('/book/confirm');
    }

    public function render()
    {
        return view('livewire.booking-wizard', [
            'selectedTalent' => $this->talent_id ? Talent::find($this->talent_id) : null,
        ])->layout('components.layouts.app', ['title' => 'Book Talent | Hailerz Entertainment']);
    }
}
