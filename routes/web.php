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
use Illuminate\Support\Facades\Route;

// Public Frontends
Route::get('/', Home::class)->name('home');
Route::get('/talent', TalentDirectory::class)->name('talent.directory');
Route::get('/talent/{slug}', ShowTalent::class)->name('talent.show');
Route::get('/book', BookingWizard::class)->name('booking.wizard');
Route::get('/book/confirm', BookingConfirmation::class)->name('booking.confirmation');

Route::get('/about', About::class)->name('about');
Route::get('/services', Services::class)->name('services');
Route::get('/join', JoinRoster::class)->name('join');

// News / Blog
Route::get('/news', PostList::class)->name('news.index');
Route::get('/news/{slug}', ShowPost::class)->name('news.show');
