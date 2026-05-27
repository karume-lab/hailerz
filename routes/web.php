<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\OgImageController;
use App\Http\Controllers\PreviewController;
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
Route::get('/maintenance', function () {
    if (! config('app.maintenance.enabled')) {
        return redirect('/');
    }

    return view('maintenance');
})->name('maintenance');

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

// Developer Preview Hub (local only — enforced inside PreviewController)
Route::prefix('previews')->group(function () {
    Route::get('/', [PreviewController::class, 'index'])->name('previews.index');
    Route::get('/pdfs', [PreviewController::class, 'pdfs'])->name('previews.pdfs');
    Route::get('/emails', [PreviewController::class, 'emails'])->name('previews.emails');
    Route::get('/pdfs/view/{type}', [PreviewController::class, 'viewPdf'])->name('previews.pdfs.view');
    Route::get('/emails/view/{template}', [PreviewController::class, 'viewEmail'])->name('previews.emails.view');
});

use App\Http\Controllers\PaymentController;

Route::get('/payment/callback', [PaymentController::class, 'handleGatewayCallback'])->name('pay.callback');

// Exclude this route from CSRF protection middleware (typically handled in bootstrap/app.php or HTTP Kernel, but we'll define route here)
Route::post('/paystack/webhook', [PaymentController::class, 'handleWebhook']);

Route::prefix('contracts')->group(function () {
    Route::get('/{contract}', [ContractController::class, 'show'])->name('contracts.show');
    Route::post('/{contract}', [ContractController::class, 'sign'])->name('contracts.sign');
    Route::post('/{contract}/revision', [ContractController::class, 'requestRevision'])->name('contracts.revision');
    Route::get('/{contract}/download', [ContractController::class, 'download'])->name('contracts.download');
    Route::post('/{oldContract}/new-version', [ContractController::class, 'publishNewVersion'])->name('contracts.new-version');
});
