<?php

use App\Livewire\Public\Home;
use App\Livewire\Public\TalentDirectory;
use App\Livewire\Public\ShowTalent;
use App\Livewire\Public\BookingWizard;
use App\Livewire\Public\About;
use App\Livewire\Public\Services;
use App\Livewire\Public\JoinRoster;
use App\Livewire\BookingConfirmation;
use App\Livewire\PostList;
use App\Livewire\ShowPost;
use App\Livewire\Public\Legal\TermsOfService;
use App\Livewire\Public\Legal\PrivacyPolicy;
use App\Livewire\Public\Legal\BookingAgreement;
use App\Livewire\Public\Legal\CancellationPolicy;
use Illuminate\Support\Facades\Route;

// Public Frontends
Route::get('/', Home::class)->name('home');
Route::get('/talent', TalentDirectory::class)->name('talent.directory');
Route::get('/talent/{slug}', ShowTalent::class)->name('talent.show');
Route::get('/book', BookingWizard::class)->name('booking.wizard');
Route::get('/book/confirm', BookingConfirmation::class)->name('booking.confirmation');

Route::get('/about', About::class)->name('about');
Route::get('/services', Services::class)->name('services');
Route::get('/contact', \App\Livewire\Public\Contact::class)->name('contact');
Route::get('/join', JoinRoster::class)->name('join');

// Legal
Route::get('/legal/terms', TermsOfService::class)->name('legal.terms');
Route::get('/legal/privacy', PrivacyPolicy::class)->name('legal.privacy');
Route::get('/legal/booking', BookingAgreement::class)->name('legal.booking');
Route::get('/legal/cancellation', CancellationPolicy::class)->name('legal.cancellation');

// News / Blog
Route::get('/news', PostList::class)->name('news.index');
Route::get('/news/{slug}', ShowPost::class)->name('news.show');

// Maintenance
Route::view('/maintenance', 'maintenance')->name('maintenance');
