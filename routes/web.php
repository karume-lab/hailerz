<?php

use App\Livewire\Public\Home;
use App\Livewire\Public\TalentDirectory;
use App\Livewire\Public\ShowTalent;
use App\Livewire\Public\BookingWizard;
use App\Livewire\Public\About;
use App\Livewire\Public\Services;
use App\Livewire\Public\JoinTalent;
use App\Livewire\BookingConfirmation;
use App\Livewire\PostList;
use App\Livewire\ShowPost;
use App\Livewire\Public\Legal\TermsOfService;
use App\Livewire\Public\Legal\PrivacyPolicy;
use App\Livewire\Public\Legal\BookingAgreement;
use App\Livewire\Public\Legal\CancellationPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OgImageController;

// Public Frontends
Route::get('/', Home::class)->name('home');
Route::get('/talent', TalentDirectory::class)->name('talent.directory');
Route::get('/talent/{slug}', ShowTalent::class)->name('talent.show');
Route::get('/og/talent/{slug}', [OgImageController::class, 'show'])->name('og.talent');
Route::get('/book', BookingWizard::class)->name('booking.wizard');
Route::get('/book/confirm', BookingConfirmation::class)->name('booking.confirmation');

Route::get('/about', About::class)->name('about');
Route::get('/services', Services::class)->name('services');
Route::get('/staffing', \App\Livewire\Public\Staffing::class)->name('staffing');
Route::get('/contact', \App\Livewire\Public\Contact::class)->name('contact');
Route::get('/join', JoinTalent::class)->name('join');

// Legal
Route::get('/legal/terms', TermsOfService::class)->name('legal.terms');
Route::get('/legal/privacy', PrivacyPolicy::class)->name('legal.privacy');
Route::get('/legal/booking-agreement', BookingAgreement::class)->name('legal.booking');
Route::get('/legal/cancellation', CancellationPolicy::class)->name('legal.cancellation');

// News / Blog
Route::get('/news', PostList::class)->name('news.index');
Route::get('/news/{slug}', ShowPost::class)->name('news.show');

// Maintenance
Route::view('/maintenance', 'maintenance')->name('maintenance');

// CSP Violation Reports
Route::post('/csp-report', function (Request $request) {
    $report = $request->json()->all();
    if (!empty($report)) {
        Log::warning('CSP Violation', $report);
    }
    return response()->noContent();
})->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class])
  ->middleware('throttle:30,1')
  ->name('csp.report');
