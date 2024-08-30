<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\MainController as AdminMainController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\PhotoController;

Route::get('/', [MainController::class, 'index'])->name('home');

Route::get('page-details', function () {
    return view('layouts.page-details');
})->name('page-details');


Route::get('contact-us', function () {
    return view('layouts.contact-us');
})->name('contact-us');


Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {
        Route::resource('travels', TravelController::class);

        Route::resource('stages', StageController::class);

        Route::resource('travels.photos', PhotoController::class)->except(['show']);

        // Rotta personalizzata per aggiungere foto a un viaggio esistente
        Route::put('travels/{travel}/add-photos', [TravelController::class, 'addPhotos'])->name('travels.addPhotos');
        
        
        // routes/web.php
    Route::post('/travels/{travel}/photos/bulk-destroy', [PhotoController::class, 'bulkDestroy'])
    ->name('travels.photos.bulkDestroy');




    });



require __DIR__.'/auth.php';
