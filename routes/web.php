<?php

use Illuminate\Support\Facades\Route;



Route::namespace('App\Livewire\Backend\Company')->group(function() {


        // Home
        Route::get('/', Index::class)->name('index');
    

});