<?php

use Illuminate\Support\Facades\Route;


Route::namespace('App\Livewire\Backend\Employee')->middleware('auth')->prefix('employee')->as('employee.dashboard.')->group(function() {

    Route::get('/', Index::class)->name('Index');

    //Recording attendance and absence
    Route::namespace('Attendance')->prefix('attendance')->as('attendance.')->group(function() {
       
        Route::get('/', Index::class)->name('index');
        Route::get('/report', Report::class)->name('report');
    });

        //Vacation
    Route::namespace('Vacation')->prefix('vacation')->as('vacation.')->group(function() {
        
        Route::get('/', Index::class)->name('index');
    });
    // information
    Route::namespace('Information')->prefix('information')->as('information.')->group(function() {

        Route::get('/', Index::class)->name('index');

    });

    //change password
    Route::namespace('Password')->prefix('password')->as('password.')->group(function() {
        Route::get('/', Index::class)->name('index');
    });

        //Ask Permission
        Route::namespace('AskPermission')->prefix('askpermission')->as('askpermission.')->group(function() {
            Route::get('/', Index::class)->name('index');
        });

        //Resumption
        Route::namespace('Resumption')->prefix('resumption')->as('resumption.')->group(function() {
            Route::get('/', Index::class)->name('index');
        });






    

});