<?php

namespace App\Livewire\Public;

use App\Mail\EventRegistrationMail;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Hailerz | Event Registration Wizard')]
class EventsRegistrationWizard extends Component
{
    public int $currentStep = 1;

    public string $pass_type = 'attendee'; // default to attendee

    // Exhibitor fields
    public ?string $company_name = null;

    public ?string $company_description = null;

    public ?string $company_logo = null; // Base64 WebP image data

    public ?int $registrationId = null;

    public function mount()
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        if (request()->has('tier')) {
            $tier = request('tier');
            if (in_array($tier, ['attendee', 'exhibitor'])) {
                $this->pass_type = $tier;
            }
        }
    }

    public function nextStep()
    {
        if ($this->currentStep === 1) {
            if ($this->pass_type === 'attendee') {
                // Attendees bypass Step 2 (Company Intake) and proceed to checkout
                $this->currentStep = 3;
            } else {
                $this->currentStep = 2;
            }
        } elseif ($this->currentStep === 2) {
            $this->validate([
                'company_name' => 'required|string|max:255',
                'company_description' => 'required|string|max:1000',
                'company_logo' => 'nullable|string',
            ]);
            $this->currentStep = 3;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep === 3 && $this->pass_type === 'attendee') {
            $this->currentStep = 1;
        } else {
            $this->currentStep--;
        }
    }

    public function checkout()
    {
        if ($this->pass_type === 'attendee') {
            $registration = EventRegistration::create([
                'user_id' => auth()->id(),
                'pass_type' => 'attendee',
                'total_amount' => 0.00,
                'payment_status' => 'confirmed',
                'payment_reference' => 'HLZ-FREE-'.strtoupper(Str::random(10)).'-'.time(),
            ]);

            try {
                Mail::to(auth()->user()->email)->send(new EventRegistrationMail($registration));
            } catch (\Exception $e) {
                // Log or ignore mail failure during direct registration (background cron handles queue dispatch)
            }

            $this->registrationId = $registration->id;
            session()->flash('success', 'Your General Attendee registration was successful! Access ticket and receipt have been sent to your inbox.');
        } else {
            // Exhibitor details validation
            $this->validate([
                'company_name' => 'required|string|max:255',
                'company_description' => 'required|string|max:1000',
                'company_logo' => 'nullable|string',
            ]);

            $reference = 'HLZ-EVT-'.strtoupper(Str::random(12)).'-'.time();
            $amount = 30000.00;

            $registration = EventRegistration::create([
                'user_id' => auth()->id(),
                'pass_type' => 'exhibitor',
                'company_name' => $this->company_name,
                'company_description' => $this->company_description,
                'company_logo' => $this->company_logo,
                'total_amount' => $amount,
                'payment_status' => 'pending',
                'payment_reference' => $reference,
            ]);

            // Initialize Paystack payment
            $response = Http::withToken(config('paystack.secretKey'))
                ->post(config('paystack.paymentUrl').'/transaction/initialize', [
                    'email' => auth()->user()->email,
                    'amount' => (int) ($amount * 100), // Amount in cents/kobo
                    'reference' => $reference,
                    'callback_url' => route('pay.callback'),
                    'metadata' => [
                        'registration_id' => $registration->id,
                    ],
                ]);

            if (! $response->successful() || ! $response->json('status')) {
                $this->addError('payment', 'Paystack payment initialization failed: '.($response->json('message') ?? 'Unknown error'));

                return;
            }

            return redirect()->away($response->json('data.authorization_url'));
        }
    }

    public function render()
    {
        return view('livewire.public.events-registration-wizard');
    }
}
