<?php

namespace App\Http\Controllers;

use App\Mail\AdminBookingNotification;
use App\Mail\BookingConfirmationMail;
use App\Mail\EventRegistrationMail;
use App\Models\EventRegistration;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Redirect the User to Paystack Payment Page
     */
    public function redirectToGateway(Request $request)
    {
        try {
            $inquiry = Inquiry::findOrFail($request->booking_id);

            // Generate a unique transaction reference
            $reference = 'HLZ-'.strtoupper(Str::random(12)).'-'.time();

            $inquiry->update([
                'payment_reference' => $reference,
                'amount' => $request->amount,
            ]);

            // Amount must be in kobo/cents (multiply by 100)
            $response = Http::withToken(config('paystack.secretKey'))
                ->post(config('paystack.paymentUrl').'/transaction/initialize', [
                    'email' => auth()->user()->email ?? $inquiry->email,
                    'amount' => (int) ($request->amount * 100),
                    'reference' => $reference,
                    'callback_url' => route('pay.callback'),
                    'metadata' => ['booking_id' => $inquiry->id],
                ]);

            if (! $response->successful() || ! $response->json('status')) {
                throw new \Exception($response->json('message') ?? 'Paystack initialization failed.');
            }

            $authorizationUrl = $response->json('data.authorization_url');

            return Redirect::away($authorizationUrl);
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['msg' => 'The Paystack payment token generation failed. Please try again.']);
        }
    }

    /**
     * Obtain Paystack payment information from response callback
     */
    public function handleGatewayCallback(Request $request)
    {
        $reference = $request->query('reference');

        if (! $reference) {
            return redirect()->route('home')->with('error', 'Missing payment reference.');
        }

        $response = Http::withToken(config('paystack.secretKey'))
            ->get(config('paystack.paymentUrl')."/transaction/verify/{$reference}");

        if (! $response->successful() || $response->json('data.status') !== 'success') {
            return redirect()->route('home')->with('error', 'Payment authentication processing failed.');
        }

        $bookingId = $response->json('data.metadata.booking_id');
        $registrationId = $response->json('data.metadata.registration_id');

        if ($bookingId) {
            $inquiry = Inquiry::findOrFail($bookingId);

            // Advance timeline status tracker flag to Secured & Booked
            if ($inquiry->payment_status !== 'paid') {
                $inquiry->update([
                    'payment_status' => 'paid',
                    'status' => 'confirmed',
                ]);

                try {
                    Log::info('Attempting to send booking email to: '.$inquiry->email);
                    Mail::to($inquiry->email)->send(new BookingConfirmationMail($inquiry));
                    Mail::to(config('mail.from.address'))->send(new AdminBookingNotification($inquiry));
                    Log::info('Booking email sent successfully.');
                } catch (\Exception $e) {
                    Log::error('Mail sending failed: '.$e->getMessage());
                }
            }

            return redirect()->route('booking.confirmation')->with('success', 'Payment verified successfully! Your booking is locked in.');
        }

        if ($registrationId) {
            $registration = EventRegistration::findOrFail($registrationId);

            if ($registration->payment_status !== 'confirmed') {
                $registration->update([
                    'payment_status' => 'confirmed',
                    'payment_reference' => $reference,
                ]);

                try {
                    Log::info('Attempting to send event registration email to: '.$registration->user->email);
                    Mail::to($registration->user->email)->send(new EventRegistrationMail($registration));
                    Log::info('Event registration email sent successfully.');
                } catch (\Exception $e) {
                    Log::error('Event registration mail sending failed: '.$e->getMessage());
                }
            }

            return redirect()->route('events.services')->with('success', 'Payment verified successfully! Your Event / Booth is confirmed.');
        }

        return redirect()->route('home')->with('error', 'Payment processed but destination unrecognized.');
    }

    /**
     * Handle Async Server Webhook Fallbacks
     */
    public function handleWebhook(Request $request)
    {
        // Verify incoming request signature matching Paystack Header secret
        $signature = $request->header('x-paystack-signature');
        $computed = hash_hmac('sha512', $request->getContent(), config('paystack.secretKey'));

        if (! hash_equals($computed, $signature ?? '')) {
            return response()->json(['status' => 'unauthorized'], 401);
        }

        $event = $request->input('event');

        if ($event === 'charge.success') {
            $payload = $request->input('data');
            $bookingId = $payload['metadata']['booking_id'] ?? null;
            $registrationId = $payload['metadata']['registration_id'] ?? null;

            if ($bookingId) {
                $inquiry = Inquiry::find($bookingId);
                if ($inquiry && $inquiry->payment_status !== 'paid') {
                    $inquiry->update([
                        'payment_status' => 'paid',
                        'status' => 'confirmed',
                    ]);

                    try {
                        Mail::to($inquiry->email)->send(new BookingConfirmationMail($inquiry));
                        Mail::to(config('mail.from.address'))->send(new AdminBookingNotification($inquiry));
                    } catch (\Exception $e) {
                        Log::error('Webhook mail sending failed: '.$e->getMessage());
                    }
                }
            } elseif ($registrationId) {
                $registration = EventRegistration::find($registrationId);
                if ($registration && $registration->payment_status !== 'confirmed') {
                    $registration->update([
                        'payment_status' => 'confirmed',
                        'payment_reference' => $payload['reference'] ?? null,
                    ]);

                    try {
                        Mail::to($registration->user->email)->send(new EventRegistrationMail($registration));
                    } catch (\Exception $e) {
                        Log::error('Webhook event registration mail sending failed: '.$e->getMessage());
                    }
                }
            }
        }

        return response()->json(['status' => 'success'], 200);
    }
}
