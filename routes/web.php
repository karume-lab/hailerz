<?php

use Illuminate\Support\Facades\Route;

// This project uses an "anonymous-first" Livewire approach (Volt-style).
// Routes map directly to matching blade files in resources/views/livewire
// or components/⚡...

Route::livewire('/', 'talent-grid');
Route::livewire('/talent/{id}', 'talent-profile');
Route::livewire('/book', 'booking-form');
Route::livewire('/apply', 'artist-submission');