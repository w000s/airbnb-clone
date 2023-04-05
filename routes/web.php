<?php

use App\Http\Controllers\Availabilities;
use App\Http\Controllers\Accommodations;
use App\Http\Controllers\Bookings;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::controller(Accommodations::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/accommodation/{id}', 'show')->name('show');
});

Route::middleware('auth')->group(function () {
    Route::post('/create', [Accommodations::class, 'create'])->name('create');
    Route::get('/create-accommodation', [Accommodations::class, 'createAccommodationPage'])->name('createAccommodationPage');
});

Route::resource('availabilities', Availabilities::class)->only(['index', 'store'])->middleware(['auth', 'verified']);;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('book', Bookings::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
