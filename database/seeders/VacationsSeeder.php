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
        $weekdays = ['السبت', 'الأحد', 'الإثنين', 'الثلاثاء', 'الاربعاء','الخميس','الجمعة'];

        // Seed at least one vacation day using the Vacation model
        Vacation::create([
            'weekday' => 'الجمعة',
            'work_start' => '08:00:00',
            'work_end' => '17:00:00',
            'is_vacation' => true,
        ]);

        // Seed data for the remaining weekdays
        foreach ($weekdays as $weekday) {
            if ($weekday !== 'الجمعة') {
                Vacation::create([
                    'weekday' => $weekday,
                    'work_start' => '08:00:00',
                    'work_end' => '17:00:00',
                    'is_vacation' => false,
                ]);
            }
        }
    }
}
