<?php

use Illuminate\Support\Facades\Route;


Route::get('/',function() {
    return "hello";

})->name('home');

Route::namespace('App\Livewire\Backend\Company')->group(function() {




    //Employee
    Route::namespace('Employee')->prefix('employees')->as('employee.')->group(function() {
        Route::get('/', Index::class)->name('index');
        Route::get('/create', Create::class)->name('create');
        Route::get('/edit/{employee}', Edit::class)->name('edit');
        Route::get('/permession/{employee}', Permission::class)->name('permession');

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
            Route::get('/edit', Edit::class)->name('edit');
            Route::get('/show', Show::class)->name('show');

        });
    });
            // Attendance

    Route::namespace('Attendance')->prefix('attendance')->as('attendance.')->group(function() {
         Route::get('/', Index::class)->name('index');
         Route::get('/report', Report::class)->name('report');
         Route::get('/statement', Statment::class)->name('statment');
    });
    
    // Salaires

    Route::namespace('Salaires')->prefix('salaires')->as('salaires.')->group(function() {
        Route::get('/', Index::class)->name('index');
        Route::get('/payroll', Payroll::class)->name('payroll');



    });

     // Settings
    Route::namespace('Settings')->prefix('settings')->as('settings.')->group(function() {
        Route::get('/', Index::class)->name('index');
        Route::get('/main', Main::class)->name('main');
        Route::get('/branches', Branches::class)->name('branches');
        Route::get('/logo', Logo::class)->name('logo');





    });





    

});