<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        Carbon::setLocale('en');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

    }
}
