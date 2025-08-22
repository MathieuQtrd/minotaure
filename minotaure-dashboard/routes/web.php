<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Admin\PermissionController;
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

    // Création user
    Route::get('/dashboard/admin/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/dashboard/admin/users', [UserController::class, 'store'])->name('admin.users.store');
});

Route::middleware(['auth', 'permission:gerer_role'])->group( function () {
    Route::get('/dashboard/admin/roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::get('/dashboard/admin/roles/create', [RoleController::class, 'create'])->name('admin.roles.create');
    Route::get('/dashboard/admin/roles/{role}', [RoleController::class, 'show'])->name('admin.roles.show');
    Route::post('/dashboard/admin/roles', [RoleController::class, 'store'])->name('admin.roles.store');
    Route::put('/dashboard/admin/roles/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('/dashboard/admin/roles/{id}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');
    
});

Route::middleware(['auth', 'permission:gerer_permission'])->group( function () {
    Route::get('/dashboard/admin/permissions', [PermissionController::class, 'index'])->name('admin.permissions.index');
    Route::get('/dashboard/admin/permissions/create', [PermissionController::class, 'create'])->name('admin.permissions.create');
    Route::post('/dashboard/admin/permissions', [PermissionController::class, 'store'])->name('admin.permissions.store');
    Route::put('/dashboard/admin/permissions/{role}/role', [PermissionController::class, 'update'])->name('admin.permissions.update');
    Route::delete('/dashboard/admin/permissions/{id}', [PermissionController::class, 'destroy'])->name('admin.permissions.destroy');    
});

Route::middleware(['auth', 'role:admin'])->group( function () {
    Route::get('/dashboard/admin/projects', [ProjectController::class, 'index'])->name('admin.projects.index');

    Route::get('/dashboard/admin/projects/create', [ProjectController::class, 'create'])->name('admin.projects.create');
    Route::post('/dashboard/admin/projects/store', [ProjectController::class, 'store'])->name('admin.projects.store');
    Route::get('/dashboard/admin/projects/{project}', [ProjectController::class, 'show'])->name('admin.project.show');
    Route::post('/dashboard/admin/projects/add/user/{project}', [ProjectController::class, 'addUser'])->name('admin.project.user.add');
    Route::delete('/dashboard/admin/projects/remove/user/{project}/{user}', [ProjectController::class, 'removeUser'])->name('admin.project.user.remove');

});

Route::middleware(['auth', 'role:developpeur'])->group( function () {
    Route::get('/dashboard/developpeur/projects', [ProjectController::class, 'index'])->name('developpeur.projects.index');
    Route::post('/dashboard/developpeur/task/store/{project}', [TaskController::class, 'store'])->name('developpeur.task.store');
    Route::get('/dashboard/developpeur/projects/{project}', [ProjectController::class, 'show'])->name('developpeur.project.show');
    /*
    
    Route::post('/dashboard/developpeur/projects/add/user/{project}', [ProjectController::class, 'addUser'])->name('developpeur.project.user.add');
    Route::delete('/dashboard/developpeur/projects/remove/user/{project}/{user}', [ProjectController::class, 'removeUser'])->name('developpeur.project.user.remove');
    */

});

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'sendMail'])->name('contact.send');