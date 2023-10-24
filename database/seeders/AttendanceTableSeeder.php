<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;


class AttendanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();

        Carbon::setLocale('ar');


        $employees = Employee::all();
        $startDate = Carbon::today();


        
        foreach ($employees as $employee) {
            $currentDate = clone $startDate; // Create a new Carbon instance for each employee
            
            for ($i = 0; $i < 50; $i++) {
                // Calculate the day of the week
                $dayOfWeek = $currentDate->copy()->subDays($i)->format('l'); // Get the full day name (e.g., Saturday, Sunday, etc.)
                
                // Generate random attendance data
                $attendanceData = [
                    'employee_id' => $employee->id,
                    'attendance_date' => $currentDate->copy()->subDays($i), // Use copy() to create a new instance
                    'status' => $faker->randomElement(['Present', 'Absent', 'Late','Vacance']),
                    'day_of_week' => $dayOfWeek, // Add the day_of_week column
                ];
        
                // Create an attendance record
                Attendance::create($attendanceData);
            }
        }
        
        
    }
}
