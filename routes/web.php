<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\ClientIndex;
use App\Http\Livewire\ClientPage;
use App\Http\Livewire\PermissionIndex;
use App\Http\Livewire\RequirementForm;
use App\Http\Livewire\RoleIndex;
use App\Http\Livewire\UserIndex;
use Illuminate\Support\Facades\Route;


//Auth Users Group
Route::middleware('auth')->group(function () {
    
    //Controller Roues
    Route::get('/profile',      [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',    [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',   [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    //Livewire Routes
    Route::get('/my_requirements',  ClientPage::class)->name('client_page.index')->middleware('auth');


    //Local Users Group
    Route::middleware('is_local')->group(function () {
        
        //Controller Roues
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        //Livewire Routes
        Route::get('/roles',            RoleIndex::class)->name('roles.index')->middleware('can:roles_menu');
        Route::get('/permissions',      PermissionIndex::class)->name('permissions.index')->middleware('can:permissions_menu');
        Route::get('/users',            UserIndex::class)->name('users.index')->middleware('can:users_menu');
        Route::get('/clients',          ClientIndex::class)->name('clients.index')->middleware('can:clients_menu');
        Route::get('/requirements',     RequirementForm::class)->name('requirements.index')->middleware('can:requirements_menu');
    });
});

require __DIR__ . '/auth.php';
