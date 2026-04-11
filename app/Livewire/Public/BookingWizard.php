<?php

namespace App\Livewire\Public;

use App\Models\Inquiry;
use App\Models\Talent;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Layout('components.layouts.app')]
#[Title('Hailerz | Book Talent')]
class BookingWizard extends Component
{
    public int $currentStep = 1;
    public $talents;
    public ?int $preselectedTalentId = null;

    // Step 1: Event Details
    #[Validate('required|exists:talents,id')]
    public $talent_id;
    
    #[Validate('required|date|after:today')]
    public $event_date;
    
    #[Validate('required|string|max:255')]
    public $event_location;
    
    #[Validate('required|string|max:1000')]
    public $event_description;

    // Step 2: Budget
    #[Validate('required|numeric|min:500')]
    public $proposed_budget;

    // Step 3: Client Info
    #[Validate('required|string|max:255')]
    public $client_name;
    
    #[Validate('required|email|max:255')]
    public $client_email;
    
    #[Validate('required|string|max:20')]
    public $client_phone;

    public bool $isComplete = false;

    public function mount()
    {
        $this->talents = Talent::where('status', 'active')->orderBy('name')->get();
        if (request()->has('talent')) {
            $this->preselectedTalentId = request('talent');
            $this->talent_id = $this->preselectedTalentId;
        }
    }

    public function nextStep()
    {
        if ($this->currentStep === 1) {
            $this->validate([
                'talent_id' => 'required|exists:talents,id',
                'event_date' => 'required|date|after:today',
                'event_location' => 'required|string|max:255',
                'event_description' => 'required|string|max:1000',
            ]);
        } elseif ($this->currentStep === 2) {
            $this->validate([
                'proposed_budget' => 'required|numeric|min:500',
            ]);
        }
        
        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    public function submit()
    {
        $this->validate();

        Inquiry::create([
            'talent_id' => $this->talent_id,
            'client_name' => $this->client_name,
            'client_email' => $this->client_email,
            'client_phone' => $this->client_phone,
            'event_date' => $this->event_date,
            'event_location' => $this->event_location,
            'event_description' => $this->event_description,
            'proposed_budget' => $this->proposed_budget,
            'status' => 'new',
        ]);

        $this->isComplete = true;
    }

    public function render()
    {
        return view('livewire.public.booking-wizard');
    }
}
