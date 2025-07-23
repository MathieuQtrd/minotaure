<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EmployeController;


Route::get('/', [EntrepriseController::class, 'index'])->name('entreprise');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/ajouter', [ServiceController::class, 'create'])->name('services.create');
Route::post('/services/ajouter', [ServiceController::class, 'store'])->name('services.store');
Route::get('/services/modifier/{service}', [ServiceController::class, 'edit'])->name('services.edit');
Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

Route::prefix('employes')->name('employes.')->group(function () {
    Route::get('/', [EmployeController::class, 'index'])->name('index');
    Route::get('/ajouter', [EmployeController::class, 'create'])->name('create');
    Route::post('/ajouter', [EmployeController::class, 'store'])->name('store');
    Route::get('/modifier/{employe}', [EmployeController::class, 'edit'])->name('edit');
    Route::put('/{employe}', [EmployeController::class, 'update'])->name('update');
    Route::delete('/{employe}', [EmployeController::class, 'destroy'])->name('destroy');
});