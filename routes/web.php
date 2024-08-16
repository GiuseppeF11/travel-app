<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\MainController as AdminMainController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\StageController;

Route::get('/', [MainController::class, 'index'])->name('home');

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {
    
    // Rotte per Travel CRUD
    Route::resource('travels', TravelController::class);
    Route::resource('stages', StageController::class);

});

require __DIR__.'/auth.php';
