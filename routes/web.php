<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;  // ✅ add this line
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('bookings.index'); // redirect homepage to bookings
});

// Dashboard (optional)
Route::get('/dashboard', function () {
    return redirect()->route('bookings.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ Booking routes (this was commented before)
    Route::resource('bookings', BookingController::class);
});

require __DIR__.'/auth.php';
