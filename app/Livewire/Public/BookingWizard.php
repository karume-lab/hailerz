<?php

namespace App\Livewire\Public;

use App\Models\Inquiry;
use App\Models\Talent;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Layout('components.layouts.app')]
#[Title('Hailerz | Professional Inquiry')]
class BookingWizard extends Component
{
    public int $currentStep = 1;
    public string $search = '';
    public int $perPage = 10;
    public ?int $preselectedTalentId = null;

    // Step 1: Contact Information
    #[Validate('required|string|max:255')]
    public $first_name;
    
    #[Validate('required|string|max:255')]
    public $last_name;
    
    #[Validate('required|email|max:255')]
    public $email;
    
    #[Validate('required|string|max:20')]
    public $phone;
    
    #[Validate('nullable|string|max:255')]
    public $company;

    // Step 2: Event Details
    #[Validate('required|string')]
    public $event_type;
    
    #[Validate('required|date|after:today')]
    public $event_date;
    
    #[Validate('nullable|string')]
    public $event_time;
    
    #[Validate('nullable|string')]
    public $performance_duration;
    
    #[Validate('nullable|string|max:255')]
    public $venue_name;
    
    #[Validate('required|string|max:255')]
    public $city;
    
    #[Validate('required|string|max:255')]
    public $state;
    
    #[Validate('required|integer|min:1')]
    public $expected_guests;

    // Step 3: Talent Preferences
    #[Validate('required|string')]
    public $talent_category;
    
    #[Validate('nullable|string')]
    public $preferred_genre;
    
    #[Validate('nullable|string')]
    public $budget_range;
    
    #[Validate('nullable|string|max:255')]
    public $specific_talent;
    
    #[Validate('required|string|max:2000')]
    public $additional_details;

    // Step 4: Misc
    #[Validate('nullable|string')]
    public $source;

    public bool $isComplete = false;
    public $talent_id; // Keeping this for internal tracking if pre-selected

    public function mount()
    {
        if (request()->has('talent')) {
            $this->preselectedTalentId = request('talent');
            $this->talent_id = $this->preselectedTalentId;
            
            $talent = Talent::find($this->preselectedTalentId);
            if ($talent) {
                $this->specific_talent = $talent->name;
                $this->budget_range = $talent->starting_price;
                if ($talent->category) {
                    $this->talent_category = $talent->category->name;
                }
            }
        }
    }

    public function nextStep()
    {
        if ($this->currentStep === 1) {
            $this->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
            ]);
        } elseif ($this->currentStep === 2) {
            $this->validate([
                'event_type' => 'required|string',
                'event_date' => 'required|date|after:today',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'expected_guests' => 'required|integer|min:1',
            ]);
        } elseif ($this->currentStep === 3) {
            $this->validate([
                'talent_category' => 'required|string',
                'additional_details' => 'required|string|max:2000',
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'event_type' => $this->event_type,
            'event_date' => $this->event_date,
            'event_time' => $this->event_time,
            'performance_duration' => $this->performance_duration,
            'venue_name' => $this->venue_name,
            'city' => $this->city,
            'state' => $this->state,
            'expected_guests' => $this->expected_guests,
            'talent_category' => $this->talent_category,
            'preferred_genre' => $this->preferred_genre,
            'budget_range' => $this->budget_range,
            'specific_talent' => $this->specific_talent,
            'additional_details' => $this->additional_details,
            'source' => $this->source,
            'status' => 'new',
        ]);

        $this->isComplete = true;
    }

    public function render()
    {
        return view('livewire.public.booking-wizard');
    }
}
