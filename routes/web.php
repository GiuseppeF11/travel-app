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
        Route::resource('travels', TravelController::class);

        // Rotta personalizzata per aggiungere foto a un viaggio esistente
        Route::put('travels/{travel}/add-photos', [TravelController::class, 'addPhotos'])->name('travels.addPhotos');

        Route::resource('stages', StageController::class);
    });

require __DIR__.'/auth.php';
