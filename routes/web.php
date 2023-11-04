<?php

use Illuminate\Support\Facades\Route;


Route::get('/',function() {
    return "hello";

})->name('home');

Route::namespace('App\Livewire\Backend\Company')->as('company.dashboard.')->group(function() {

    Route::middleware('checkDefaultPassword')->group(function ()  {
        Route::get('/admin/home', Index::class)->name('Index');


        //Employee
        Route::namespace('Employee')->prefix('employees')->as('employee.')->group(function() {
            Route::get('/', Index::class)->name('index')->middleware('checker:read-employee');
            Route::get('/create', Create::class)->name('create')->middleware('checker:create-employee');
            Route::get('/edit/{employee}', Edit::class)->name('edit')->middleware('checker:edit-employee');
            Route::get('/permession/{employee}', Permission::class)->name('permession')->middleware('checker:edit-employee');
    
        });
    
        //Vacation
        Route::namespace('Vacation')->prefix('vacation')->as('vacation.')->group(function() {
            Route::get('/', Index::class)->name('index');
            Route::get('/weekend', Weekend::class)->name('weekend')->middleware('checker:weekend-days');
            Route::get('/worktime', Worktime::class)->name('worktime')->middleware('checker:employees-working-hours');
            Route::get('/worktime/{employee}', WorktimeEdit::class)->name('worktimeedit')->middleware('checker:employees-working-hours');
    
            // Vacation/Annual Holiday
            Route::namespace('AnnualHoliday')->prefix('annualholiday')->as('annualholiday.')->group(function () {
                Route::get('/', Index::class)->name('index')->middleware('checker:annual-leave');
                Route::get('/create', Create::class)->name('create')->middleware('checker:annual-leave');
                Route::get('/edit', Edit::class)->name('edit')->middleware('checker:annual-leave');
                Route::get('/show', Show::class)->name('show')->middleware('checker:annual-leave');
    
            });
        });
                // Attendance
    
        Route::namespace('Attendance')->prefix('attendance')->as('attendance.')->group(function() {
             Route::get('/', Index::class)->name('index');
             Route::get('/report', Report::class)->name('report')->middleware('checker:read-report-attendance');
             Route::get('/statement', Statment::class)->name('statment')->middleware('checker:read-statment-attendance');
        });
        
        // Salaires
    
        Route::namespace('Salaires')->prefix('salaires')->as('salaires.')->group(function() {
            Route::get('/', Index::class)->name('index');
            Route::get('/payroll', Payroll::class)->name('payroll')->middleware('checker:salaries-and-commissions');
        });
    
         // Settings
        Route::namespace('Settings')->prefix('settings')->as('settings.')->middleware('checker:company-settings')->group(function() {
            Route::get('/', Index::class)->name('index');
            Route::get('/main', Main::class)->name('main');
            Route::get('/branches', Branches::class)->name('branches');
            Route::get('/logo', Logo::class)->name('logo');
        });
    
             // Resumption
        Route::namespace('Resumption')->prefix('resumption')->as('resumption.')->middleware('checker:appeal-requests')->group(function() {
            Route::get('/', Index::class)->name('index');
        });
    
                 // AskPermission
        Route::namespace('AskPermission')->prefix('askpermission')->as('askpermission.')->middleware('checker:ask-permission')->group(function() {
            Route::get('/', Index::class)->name('index');
    
        });
        
    });

        // Resumption
    Route::namespace('Password')->prefix('password')->prefix('adminstrator')->as('password.')->group(function() {
            Route::get('/', Index::class)->name('index');
    });









    

});