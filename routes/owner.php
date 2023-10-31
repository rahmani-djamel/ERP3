<?php

use Illuminate\Support\Facades\Route;

Route::namespace('App\Livewire\Backend\Owner')->middleware(['auth','checker:all'])->prefix('owner')->as('owner.dashboard.')->group(function() {

    Route::get('/', Index::class)->name('Index');

       //Packages
    Route::namespace('Packages')->prefix('packages')->as('packages.')->group(function() {
        
        Route::get('/', Index::class)->name('index');
        Route::get('/create', Create::class)->name('create');
        Route::get('/edit/{package}', Edit::class)->name('edit');
    });
           //Packages
    Route::namespace('Companies')->prefix('companies')->as('companies.')->group(function() {
        Route::get('/', Index::class)->name('index');
        Route::get('/create', Create::class)->name('create');


    
    });


});