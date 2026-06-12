<?php

namespace Tests\Feature;

use App\Livewire\Public\EventsRegistrationWizard;
use App\Mail\EventRegistrationMail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

class EventRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_access_wizard(): void
    {
        $this->get('/events/tickets')
            ->assertStatus(200);
    }

    public function test_authenticated_user_can_access_registration_wizard(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/events/tickets')
            ->assertStatus(200);
    }

    public function test_free_attendee_registration_succeeds_and_sends_email(): void
    {
        Mail::fake();

        $user = User::factory()->create();

        $component = Livewire::actingAs($user)
            ->test(EventsRegistrationWizard::class);

        $component->set('pass_type', 'attendee');
        $this->assertEquals(1, $component->get('currentStep'));

        // Attendee goes directly from Step 1 to Step 3
        $component->call('nextStep');
        $this->assertEquals(3, $component->get('currentStep'));

        // Checkout free registration
        $component->call('checkout');

        $this->assertDatabaseHas('event_registrations', [
            'user_id' => $user->id,
            'pass_type' => 'attendee',
            'total_amount' => 0.00,
            'payment_status' => 'confirmed',
        ]);

        Mail::assertQueued(EventRegistrationMail::class);
    }

    public function test_paid_exhibitor_registration_validates_company_profile_and_initializes_payment(): void
    {
        Http::fake([
            'api.paystack.co/*' => Http::response([
                'status' => true,
                'message' => 'Authorization URL created',
                'data' => [
                    'authorization_url' => 'https://checkout.paystack.com/mock-url',
                    'access_code' => 'mock-code',
                    'reference' => 'mock-reference',
                ],
            ], 200),
        ]);

        $user = User::factory()->create();

        $component = Livewire::actingAs($user)
            ->test(EventsRegistrationWizard::class);

        $component->set('pass_type', 'exhibitor');

        // Go to Step 2
        $component->call('nextStep');
        $this->assertEquals(2, $component->get('currentStep'));

        // Try to continue without filling company profile
        $component->call('nextStep');
        $this->assertEquals(2, $component->get('currentStep'));
        $component->assertHasErrors(['company_name', 'company_description']);

        // Fill company profile
        $component->set('company_name', 'Acme Corp')
            ->set('company_description', 'Building beautiful gadgets since 1999')
            ->set('company_logo', 'data:image/webp;base64,UklGRkAAAABXRUJQVlA4IDQAAADwAQCdASoBAAEALm0okEYgGHEgRAAA');

        $component->call('nextStep');
        $this->assertEquals(3, $component->get('currentStep'));
        $component->assertHasNoErrors();

        // Submit checkout
        $redirect = $component->call('checkout');

        $this->assertDatabaseHas('event_registrations', [
            'user_id' => $user->id,
            'pass_type' => 'exhibitor',
            'company_name' => 'Acme Corp',
            'company_description' => 'Building beautiful gadgets since 1999',
            'total_amount' => 30000.00,
            'payment_status' => 'pending',
        ]);

        /** @var mixed $redirect */
        $this->assertEquals('https://checkout.paystack.com/mock-url', $redirect->effects['redirect']);
    }
}
