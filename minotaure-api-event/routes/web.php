<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('events.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function() {
    Route::resource('events', EventController::class);
    // resource nous crée les routes suivantes :
    // GET      admin/events               admin.events.index
    // GET      admin/events/create        admin.events.create
    // POST     admin/events               admin.events.store
    // GET      admin/events/{event}       admin.events.show
    // GET      admin/events/{event}/edit  admin.events.edit
    // PUT      admin/events/{event}       admin.events.update
    // DELETE   admin/events/{event}       admin.events.destroy
});

Route::get('/events', function() {
    return view('events.index');
})->name('events.index');

Route::get('/events/{event}', function($event) {
    return view('events.show', ['event' => $event]);
})->name('events.show');