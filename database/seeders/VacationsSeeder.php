<?php

namespace Database\Seeders;

use App\Models\Vacation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VacationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $englishWeekdays = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    
        // Seed at least one vacation day using the Vacation model
        Vacation::create([
            'weekday' => 'Friday',  // Change to 'Friday' for English
            'work_start' => '08:00:00',
            'work_end' => '17:00:00',
            'is_vacation' => true,
        ]);
    
        Vacation::create([
            'weekday' => 'Saturday',  // Change to 'Saturday' for English
            'work_start' => '08:00:00',
            'work_end' => '17:00:00',
            'is_vacation' => true,
        ]);
    
        // Seed data for the remaining weekdays
        foreach ($englishWeekdays as $weekday) {
            Vacation::create([
                'weekday' => $weekday,
                'work_start' => '08:00:00',
                'work_end' => '17:00:00',
                'is_vacation' => false,
            ]);
        }
    }
    
}
