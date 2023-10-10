<?php

use Illuminate\Support\Facades\Route;


Route::namespace('App\Livewire\Backend\Employee')->prefix('employee')->as('employee.')->group(function() {

    Route::get('/', Index::class)->name('EIndex');
    

});