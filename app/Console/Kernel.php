<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        $schedule->command('attendance:check')
        ->daily()
        ->at('23:00')
        ->timezone('Asia/Riyadh'); // Set the timezone to 'Asia/Riyadh' (Saudi Arabia)

        $schedule->command('app:update-companies')
        ->timezone('Asia/Riyadh') // Set the timezone to 'Asia/Riyadh' (Saudi Arabia)
        ->dailyAt('00:01');
}

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
