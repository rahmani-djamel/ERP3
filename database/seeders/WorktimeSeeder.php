<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Vacation;
use App\Models\Worktime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorktimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();
        $vacations = Vacation::all();

        foreach ($employees as $key => $employee) {

            foreach ($vacations as $key => $day) {

                $worktime = new Worktime();

                $worktime->employee_id = $employee->id;
                $worktime->vacation_id = $day->id;
                $worktime->work_start = $day->work_start;
                $worktime->work_end = $day->work_end;
                $worktime->is_vacation = $day->is_vacation;
                $worktime->weekday = $day->weekday;

                $worktime->save();

                
            }   
        }
    }
}
