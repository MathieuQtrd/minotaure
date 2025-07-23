<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DevisController;

Route::get('/', function () { return view('accueil'); });

Route::get('/galerie', function () { return view('galerie'); });

Route::get('/mentions', function () { return view('mentions'); })->name('mentions');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact');
Route::get('/contacts', [ContactController::class, 'list'])->name('list_contact');

Route::get('/devis', [DevisController::class, 'create'])->name('devis.create');
Route::post('/devis', [DevisController::class, 'store'])->name('devis.store');
Route::get('/liste_devis', [DevisController::class, 'list'])->name('devis.list');
