<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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

// accès selon le role
Route::get('/dashboard/admin', function () {
    return  view('admin.dashboard');
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');

Route::get('/dashboard/client', function () {
    return  view('client.dashboard');
})->middleware(['auth', 'role:client'])->name('client.dashboard');

Route::get('/dashboard/developpeur', function () {
    return  view('developpeur.dashboard');
})->middleware(['auth', 'role:developpeur'])->name('developpeur.dashboard');

// accès selon une permission
Route::get('/dashboard/projects/create', function () {
    return  view('projects.create');
})->middleware(['auth', 'permission:creer_projet'])->name('projects.create');

// Gestion utilisateur
Route::middleware(['auth', 'permission:gerer_utilisateur'])->group( function () {
    Route::get('/dashboard/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::put('/dashboard/admin/users/{id}/role', [UserController::class, 'updateRole'])->name('admin.users.updaterole');
    Route::delete('/dashboard/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});