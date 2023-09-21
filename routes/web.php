<?php

use Illuminate\Support\Facades\Route;



Route::namespace('App\Livewire\Backend\Company')->group(function() {


    Route::namespace('Employee')->prefix('employee')->as('employee.')->group(function() {
        Route::get('/', Index::class)->name('index');
        Route::get('/create', Create::class)->name('create');
        Route::get('/edit{employee}', Index::class)->name('edit');


    });
    

});