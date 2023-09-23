<?php

use Illuminate\Support\Facades\Route;



Route::namespace('App\Livewire\Backend\Company')->group(function() {




    //Employee
    Route::namespace('Employee')->prefix('employee')->as('employee.')->group(function() {
        Route::get('/', Index::class)->name('index');
        Route::get('/create', Create::class)->name('create');
        Route::get('/edit/{employee}', Edit::class)->name('edit');
    });

    //Vacation
    Route::namespace('Vacation')->prefix('vacation')->as('vacation.')->group(function() {
        Route::get('/', Index::class)->name('index');
        Route::get('/weekend', Weekend::class)->name('weekend');
        Route::get('/worktime', Worktime::class)->name('worktime');
        Route::get('/worktime/{employee}', WorktimeEdit::class)->name('worktimeedit');

        // Vacation/Annual Holiday
        Route::namespace('AnnualHoliday')->prefix('annualholiday')->as('annualholiday.')->group(function () {
            Route::get('/', Index::class)->name('index');
            Route::get('/create', Create::class)->name('create');



        });



    });


    

});