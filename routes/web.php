<?php

use App\Http\Controllers\Availabilities;
use App\Http\Controllers\Accommodations;
use App\Http\Controllers\Bookings;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::controller(Accommodations::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/accommodation/{id}', 'show')->name('show');
    Route::get('/accommodation-to-update/{id}', 'accommodationToUpdate')->name('accommodationToUpdate');
    Route::put('/accommodation-update/{id}', 'update')->name('accommodationUpdate');
});

Route::middleware('auth')->group(function () {
    Route::post('/create', [Accommodations::class, 'create'])->name('create');
    Route::get('/create-accommodation', [Accommodations::class, 'createAccommodationPage'])->name('createAccommodationPage');
});

Route::get('/availability-booking/{id}', [Availabilities::class, 'getAvailabilityFromBooking'])->name('availability-booking')->middleware(['auth', 'verified']);
Route::resource('availabilities', Availabilities::class)->only(['index', 'store', 'getAvailabilityFromBooking', 'update'])->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/tiny-house', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/view-booking/{id}', [Bookings::class, 'viewBooking'])->name('view-booking')->middleware(['auth', 'verified']);

Route::resource('book', Bookings::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
