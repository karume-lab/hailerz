<?php

use App\Livewire\BookingConfirmation;
use App\Livewire\BookingWizard;
use App\Livewire\Home;
use App\Livewire\PostList;
use App\Livewire\ShowPost;
use App\Livewire\ShowTalent;
use App\Livewire\TalentDirectory;
use Illuminate\Support\Facades\Route;

// Public Frontends
Route::get('/', Home::class)->name('home');
Route::get('/talent', TalentDirectory::class)->name('talent.directory');
Route::get('/talent/{slug}', ShowTalent::class)->name('talent.show');
Route::get('/book', BookingWizard::class)->name('booking.wizard');
Route::get('/book/confirm', BookingConfirmation::class)->name('booking.confirmation');

// News / Blog
Route::get('/news', PostList::class)->name('news.index');
Route::get('/news/{slug}', ShowPost::class)->name('news.show');
