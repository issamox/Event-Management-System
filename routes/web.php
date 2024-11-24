<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Redirect the root URL to the dashboard
Route::redirect('/', '/dashboard');


// User with an Admin role
Route::middleware(['auth','is_admin'])->group(function () {

    // Admins can access the full Events and users resource controller (CRUD actions)
    Route::resource('events', EventController::class);
    Route::resource('users', UserController::class);
});

// User with a User role
Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Routes for users to view events and RSVP (reservation)
    Route::get('events', [EventController::class, 'index'])->name('events.index');  // List of events
    Route::get('events/{event}', [EventController::class, 'show'])->name('events.show');
    Route::post('events/{event}/rsvp', [EventController::class, 'rsvp'])->name('events.rsvp');  // RSVP action (reservation)

});


// Authentication routes
require __DIR__.'/auth.php';

