<?php

use Illuminate\Support\Facades\Route;


Route::namespace('App\Livewire\Backend\Employee')->middleware('auth')->prefix('employee')->as('employee.dashboard.')->group(function() {

    Route::get('/', Index::class)->name('Index');

    //Recording attendance and absence
    Route::namespace('Attendance')->prefix('attendance')->as('attendance.')->group(function() {
       
        Route::get('/', Index::class)->name('index');

    });

    

});