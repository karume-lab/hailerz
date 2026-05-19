<?php

namespace App\Livewire\Public;

use App\Helpers\CurrencyHelper;
use App\Mail\AdminBookingNotification;
use App\Mail\BookingConfirmationMail;
use App\Models\Inquiry;
use App\Models\Talent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Hailerz | Professional Inquiry')]
class BookingWizard extends Component
{
    use WithPagination;

    public int $currentStep = 1;

    public string $search = '';

    public int $perPage = 10;

    public ?int $preselectedTalentId = null;

    public string $talentSearch = '';

    public int $talentLimit = 5;

    public ?Talent $selectedTalent = null;

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

    #[Validate('nullable|string|max:2000')]
    public $additional_details;

    // Step 4: Misc
    #[Validate('nullable|string')]
    public $source;

    #[Validate('accepted', message: 'Please confirm that the information provided is accurate.')]
    public bool $is_accurate = false;

    public bool $isComplete = false;

    public $talent_id; // Keeping this for internal tracking if pre-selected

    public function mount()
    {
        if (request()->has('talent')) {
            $this->selectTalent(request('talent'));
        }
    }

    #[Computed]
    public function searchableTalents()
    {
        $query = Talent::where('status', 'active');

        if ($this->budget_range) {
            $maxPrice = null;

            // Try to extract numbers from the budget string (handles "10k", "10,000", "10,000 - 20,000", etc.)
            $cleanString = str_replace([',', '₦', '$', '£', '€'], '', $this->budget_range);
            preg_match_all('/(\d+)(k)?/i', $cleanString, $matches);

            if (! empty($matches[1])) {
                $numbers = [];
                foreach ($matches[1] as $index => $num) {
                    $val = (float) $num;
                    $suffix = strtolower($matches[2][$index] ?? '');
                    if ($suffix === 'k') {
                        $val *= 1000;
                    }
                    $numbers[] = $val;
                }
                // For ranges, we take the upper bound as the maxPrice
                $maxPrice = max($numbers);
            }

            if ($maxPrice) {
                // Convert back to USD for DB comparison
                $currency = CurrencyHelper::getUserCurrency();
                $rate = CurrencyHelper::convert(1.0, $currency);
                $usdPrice = $rate > 0 ? ($maxPrice / $rate) : $maxPrice;
                $query->where('starting_price', '<=', $usdPrice);
            }
        }

        return $query->when($this->talentSearch, function ($query) {
            $query->where('name', 'like', '%'.$this->talentSearch.'%');
        })
            ->with('category')
            ->limit($this->talentLimit)
            ->get();
    }

    public function loadMoreTalents()
    {
        $this->talentLimit += 5;
    }

    public function selectTalent($talentId)
    {
        $talent = Talent::with('category')->find($talentId);
        if ($talent) {
            if ($talent->is_frozen) {
                return;
            }
            $this->selectedTalent = $talent;
            $this->talent_id = $talent->id;
            $this->specific_talent = $talent->name;

            // Auto-fill category if available
            if ($talent->category) {
                $this->talent_category = $talent->category->name;
            }

            // Auto-fill budget if starting price is available
            if ($talent->starting_price) {
                $currency = CurrencyHelper::getUserCurrency();
                $convertedPrice = CurrencyHelper::convert((float) $talent->starting_price, $currency);
                $options = CurrencyHelper::getBudgetOptions($currency);

                if ($currency === 'NGN') {
                    if ($convertedPrice < 1500000) {
                        $this->budget_range = $options[0];
                    } elseif ($convertedPrice <= 3750000) {
                        $this->budget_range = $options[1];
                    } elseif ($convertedPrice <= 7500000) {
                        $this->budget_range = $options[2];
                    } elseif ($convertedPrice <= 11250000) {
                        $this->budget_range = $options[3];
                    } elseif ($convertedPrice <= 15000000) {
                        $this->budget_range = $options[4];
                    } elseif ($convertedPrice <= 22500000) {
                        $this->budget_range = $options[5];
                    } elseif ($convertedPrice <= 30000000) {
                        $this->budget_range = $options[6];
                    } else {
                        $this->budget_range = $options[7];
                    }
                } elseif ($currency === 'GBP') {
                    if ($convertedPrice < 800) {
                        $this->budget_range = $options[0];
                    } elseif ($convertedPrice <= 2000) {
                        $this->budget_range = $options[1];
                    } elseif ($convertedPrice <= 4000) {
                        $this->budget_range = $options[2];
                    } elseif ($convertedPrice <= 6000) {
                        $this->budget_range = $options[3];
                    } elseif ($convertedPrice <= 8000) {
                        $this->budget_range = $options[4];
                    } elseif ($convertedPrice <= 12000) {
                        $this->budget_range = $options[5];
                    } elseif ($convertedPrice <= 16000) {
                        $this->budget_range = $options[6];
                    } else {
                        $this->budget_range = $options[7];
                    }
                } elseif ($currency === 'EUR') {
                    if ($convertedPrice < 900) {
                        $this->budget_range = $options[0];
                    } elseif ($convertedPrice <= 2300) {
                        $this->budget_range = $options[1];
                    } elseif ($convertedPrice <= 4600) {
                        $this->budget_range = $options[2];
                    } elseif ($convertedPrice <= 6900) {
                        $this->budget_range = $options[3];
                    } elseif ($convertedPrice <= 9200) {
                        $this->budget_range = $options[4];
                    } elseif ($convertedPrice <= 13800) {
                        $this->budget_range = $options[5];
                    } elseif ($convertedPrice <= 18400) {
                        $this->budget_range = $options[6];
                    } else {
                        $this->budget_range = $options[7];
                    }
                } else {
                    // USD
                    if ($convertedPrice < 1000) {
                        $this->budget_range = $options[0];
                    } elseif ($convertedPrice <= 2500) {
                        $this->budget_range = $options[1];
                    } elseif ($convertedPrice <= 5000) {
                        $this->budget_range = $options[2];
                    } elseif ($convertedPrice <= 7500) {
                        $this->budget_range = $options[3];
                    } elseif ($convertedPrice <= 10000) {
                        $this->budget_range = $options[4];
                    } elseif ($convertedPrice <= 15000) {
                        $this->budget_range = $options[5];
                    } elseif ($convertedPrice <= 20000) {
                        $this->budget_range = $options[6];
                    } else {
                        $this->budget_range = $options[7];
                    }
                }
            }
        }
        $this->talentSearch = '';
    }

    public function clearTalent()
    {
        $this->selectedTalent = null;
        $this->talent_id = null;
        $this->specific_talent = '';
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
                'budget_range' => 'required|string',
                'additional_details' => 'nullable|string|max:2000',
            ]);
        } elseif ($this->currentStep === 4) {
            $this->validate([
                'is_accurate' => 'accepted',
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

        $inquiry = Inquiry::create([
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
            'currency' => CurrencyHelper::getUserCurrency(),
        ]);

        try {
            Log::info('Attempting to send booking email to: '.$inquiry->email);
            Mail::to($inquiry->email)->send(new BookingConfirmationMail($inquiry));
            Mail::to(config('mail.from.address'))->send(new AdminBookingNotification($inquiry));
            Log::info('Booking email sent successfully.');
        } catch (\Exception $e) {
            Log::error('Mail sending failed: '.$e->getMessage());
        }

        $this->isComplete = true;
    }

    public function render()
    {
        return view('livewire.public.booking-wizard');
    }
}
