<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\OgImageController;
use App\Livewire\BookingConfirmation;
use App\Livewire\Public\About;
use App\Livewire\Public\BookingWizard;
use App\Livewire\Public\Contact;
use App\Livewire\Public\Home;
use App\Livewire\Public\JoinTalent;
use App\Livewire\Public\Legal\BookingAgreement;
use App\Livewire\Public\Legal\CancellationPolicy;
use App\Livewire\Public\Legal\PrivacyPolicy;
use App\Livewire\Public\Legal\TermsOfService;
use App\Livewire\Public\Resources;
use App\Livewire\Public\Services;
use App\Livewire\Public\ShowResource;
use App\Livewire\Public\ShowTalent;
use App\Livewire\Public\Staffing;
use App\Livewire\Public\TalentDirectory;
use App\Models\Contract;
use App\Models\Inquiry;
use App\Models\Submission;
use App\Models\Talent;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

// Service Worker with dynamic versioning
Route::get('/sw.js', function () {
    $version = Cache::remember('sw_version', 60, function () {
        // Try to get the git commit hash, fallback to a timestamp
        $hash = trim(@shell_exec('git rev-parse --short HEAD'));

        return $hash ?: time();
    });

    return response()
        ->view('sw-js', ['version' => $version])
        ->header('Content-Type', 'application/javascript')
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
});

// Public Frontends
Route::get('/', Home::class)->name('home');
Route::get('/talent', TalentDirectory::class)->name('talent.directory');
Route::get('/talent/{slug}', ShowTalent::class)->name('talent.show');
Route::get('/og/talent/{slug}', [OgImageController::class, 'show'])->name('og.talent');
Route::get('/og/resource/{slug}', [OgImageController::class, 'resource'])->name('og.resource');
Route::get('/book', BookingWizard::class)->name('booking.wizard');
Route::get('/book/confirm', BookingConfirmation::class)->name('booking.confirmation');

Route::get('/about', About::class)->name('about');
Route::get('/resources', Resources::class)->name('resources');
Route::get('/resources/{slug}', ShowResource::class)->name('resources.show');
Route::get('/services', Services::class)->name('services');
Route::get('/staffing', Staffing::class)->name('staffing');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/join', JoinTalent::class)->name('join');

// Legal
Route::get('/legal/terms', TermsOfService::class)->name('legal.terms');
Route::get('/legal/privacy', PrivacyPolicy::class)->name('legal.privacy');
Route::get('/legal/booking-agreement', BookingAgreement::class)->name('legal.booking');
Route::get('/legal/cancellation', CancellationPolicy::class)->name('legal.cancellation');

// Maintenance
Route::view('/maintenance', 'maintenance')->name('maintenance');

// CSP Violation Reports
Route::post('/csp-report', function (Request $request) {
    $report = $request->json()->all();
    if (! empty($report)) {
        Log::warning('CSP Violation', $report);
    }

    return response()->noContent();
})->withoutMiddleware([VerifyCsrfToken::class])
    ->middleware('throttle:30,1')
    ->name('csp.report');

// Digital Signature Engine Routes

Route::get('/view-pdfs/{type?}', function ($type = null) {
    if (! app()->environment('local')) {
        abort(403, 'Testing endpoint is only available in local environment.');
    }

    if (! $type) {
        return view('pdf-viewer');
    }

    $html = '';

    if ($type === 'talent-representation-agreement') {
        $talent = Talent::first() ?? new class
        {
            public $name = 'Demo Artist';

            public $email = 'demo@example.com';

            public $location = 'Lagos, NG';
        };

        $contract = Contract::first() ?? new class
        {
            public $id = 'CTR-10001';

            public $version = '1.0';

            public $status = 'signed';

            public $file_path = 'private/contracts/demo.pdf';

            public $file_hash = '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92';
        };

        $signatures = collect([
            (object) [
                'signer_role' => 'Agency Representative',
                'signer_identifier' => 'Jane Admin',
                'signed_at' => now(),
                'ip_address' => '192.168.1.55',
                'token_id' => 'tok_abcd1234',
                'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)',
            ],
            (object) [
                'signer_role' => 'Artist / Act',
                'signer_identifier' => 'Demo Artist',
                'signed_at' => now(),
                'ip_address' => '10.0.0.4',
                'token_id' => 'tok_efgh5678',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
            ],
        ]);

        $contentHtml = view('pdf.talent-representation-agreement', compact('talent'))->render();
        $certHtml = view('pdf.contract_certificate', compact('contract', 'signatures'))->render();

        if (str_contains(strtolower($contentHtml), '</body>')) {
            $pos = strripos($contentHtml, '</body>');
            $html = substr_replace($contentHtml, "\n".$certHtml."\n", $pos, 0);
        } else {
            $html = $contentHtml."\n".$certHtml;
        }

    } elseif ($type === 'booking-inquiry') {
        $inquiry = Inquiry::first() ?? new class
        {
            public $id = 'INQ-555';

            public $name = 'Demo Organizer';

            public $email = 'org@example.com';

            public $phone = '+234 800 000 0000';

            public $company = 'Event Corp';

            public $event_type = 'Corporate Gala';

            public $event_date = '2026-12-31';

            public $event_time = '19:00';

            public $venue_name = 'Eko Hotel';

            public $city = 'Lagos';

            public $state = 'LA';

            public $expected_guests = '500+';

            public $performance_duration = '2 Hours';

            public $budget_range = '$5,000 - $10,000';

            public $specific_talent = 'Demo Artist';

            public $additional_details = 'We need a full band setup.';

            public $created_at = '2026-05-19 12:00:00';
        };
        $html = view("pdf.{$type}", compact('inquiry'))->render();
    } elseif ($type === 'talent-submission') {
        $submission = Submission::first() ?? new class
        {
            public $id = 1;

            public $status = 'pending';

            public $artist_name = 'Demo Act';

            public $real_name = 'Real Demo';

            public $email = 'demoact@example.com';

            public $phone = '+234 800 123 4567';

            public $location = 'Lagos, NG';

            public $category = 'Musicians';

            public $genre = 'Afrobeats';

            public $years_active = '5';

            public $min_rate = '500';

            public $max_rate = '2000';

            public $currency = 'USD';

            public $bio = 'A very talented demo act.';

            public $instagram_handle = '@demoact';

            public $website_url = null;

            public $facebook_url = null;

            public $youtube_channel = null;

            public $tiktok_handle = null;

            public $notable_clients = null;

            public $created_at;

            public $gallery;

            public function __construct()
            {
                $this->created_at = now();
                $this->gallery = collect([]);
            }
        };
        $html = view("pdf.{$type}", compact('submission'))->render();
    } else {
        abort(404, 'PDF template not found');
    }

    return Pdf::loadHTML($html)
        ->setPaper('a4', 'portrait')
        ->setWarnings(false)
        ->stream("{$type}.pdf");
});

Route::prefix('contracts')->group(function () {
    Route::get('/{contract}', [ContractController::class, 'show'])->name('contracts.show');
    Route::post('/{contract}', [ContractController::class, 'sign'])->name('contracts.sign');
    Route::post('/{contract}/revision', [ContractController::class, 'requestRevision'])->name('contracts.revision');
    Route::get('/{contract}/download', [ContractController::class, 'download'])->name('contracts.download');
    Route::post('/{oldContract}/new-version', [ContractController::class, 'publishNewVersion'])->name('contracts.new-version');
});
