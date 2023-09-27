<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nationalities = ['السعودية', 'الكويت'];
        $vacationDays = ['الخميس', 'الأحد'];

              // Sample data for the 'settings' table
              Setting::create([
                'DaysMonth' => 1,
                'MinVacationDays' => 5,
                'Nationality' => json_encode($nationalities), // Serialize the array
                'VacationDay' => json_encode($vacationDays),
                'ValidityOfAnnualLeave' => 30,
                'Guarantee' => 1,
                'WillPay' => 1,
                'MaximumVacationEmployees' => 100,
                'PathCreated' => now(),
                'AutomaticDeduction' => 1,
                'PeriodBetweenTwoVacations' => 15,
                'SubmittingLeave' => 1,
                'AutomaticApproval' => 1,
            ]);
    }
}
