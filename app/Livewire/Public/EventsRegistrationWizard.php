<?php

namespace App\Livewire\Public;

use App\Mail\EventRegistrationMail;
use App\Models\Event;
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

    public ?string $guest_name = null;

    public ?string $guest_email = null;

    public ?int $registrationId = null;

    public ?Event $event = null;

    public function mount()
    {
        $this->event = Event::latest('date')->first();

        if (auth()->check()) {
            $this->guest_name = auth()->user()->name;
            $this->guest_email = auth()->user()->email;
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
        if (! $this->event) {
            $this->addError('payment', 'No active event available for registration.');

            return;
        }

        $this->validate([
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
        ]);

        if ($this->pass_type === 'attendee') {
            $registration = EventRegistration::create([
                'user_id' => auth()->id(),
                'guest_name' => $this->guest_name,
                'guest_email' => $this->guest_email,
                'event_id' => $this->event->id,
                'pass_type' => 'attendee',
                'total_amount' => $this->event->attendee_price ?? 0.00,
                'payment_status' => 'confirmed',
                'payment_reference' => 'HLZ-FREE-'.strtoupper(Str::random(10)).'-'.time(),
            ]);

            try {
                $email = $this->guest_email;
                Mail::to($email)->send(new EventRegistrationMail($registration));
            } catch (\Throwable $e) {
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

            // Standardize pricing configurations to native Nigerian Naira (NGN)
            $reference = 'HLZ-EVT-'.strtoupper(Str::random(12)).'-'.time();
            $rawAmount = $this->event->exhibitor_price ?? 350000.00;
            $amount = max($rawAmount, 100);

            $registration = EventRegistration::create([
                'user_id' => auth()->id(),
                'guest_name' => $this->guest_name,
                'guest_email' => $this->guest_email,
                'event_id' => $this->event->id,
                'pass_type' => 'exhibitor',
                'company_name' => $this->company_name,
                'company_description' => $this->company_description,
                'company_logo' => $this->company_logo,
                'total_amount' => $amount,
                'payment_status' => 'pending',
                'payment_reference' => $reference,
            ]);

            // Initialize Paystack with native NGN parameters matching our active merchant channel
            $response = Http::withToken(config('paystack.secretKey'))
                ->post(config('paystack.paymentUrl').'/transaction/initialize', [
                    'email' => $this->guest_email,
                    'amount' => (int) ($amount * 100), // Converted to kobo
                    'currency' => 'NGN', // Explicitly route to native NGN channels
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
