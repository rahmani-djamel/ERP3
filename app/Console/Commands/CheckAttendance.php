<?php

namespace App\Console\Commands;

use App\Models\AnnualHoliday;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Worktime;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:check';



    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and mark absent employees';
    /**
     * Execute the console command.
     */
    public function handle()
    {
                // Get the current date
                $currentDate = Carbon::today()->format('Y-m-d');

                $dayOfWeek = Carbon::today()->translatedFormat('l');


                // Query employees who haven't marked attendance for today
                $absentEmployees = Employee::whereDoesntHave('attendances', function ($query) use ($currentDate) {
                    $query->where('attendance_date', $currentDate);
                })->get();
        
                // Mark absent employees
                foreach ($absentEmployees as $employee)
                {
                        // Create an absent attendance record for each employee

                            // Check if the employee is on annual holiday
                        $isOnHoliday = AnnualHoliday::where('employee_id', $employee->id)
                        ->where('start_date', '<=', $currentDate)
                        ->where('end_date', '>=', $currentDate)
                        ->exists();

                        $attendance = new Attendance();
                        $attendance->employee_id = $employee->id;
                        $attendance->attendance_date = $currentDate;
                        $attendance->day_of_week = $dayOfWeek;

                    if (!$isOnHoliday) {
                        
                        // Check if the employee is marked as on vacation in the Worktime model
                        $isOnVacation = Worktime::where('employee_id', $employee->id)
                            ->whereDate('weekday', $dayOfWeek)
                            ->where('is_vacation', 1)
                            ->exists();

                        // Create an absent attendance record for employees not on holiday
                        if (!$isOnVacation) 
                        {
                            $attendance->status = "غائب";
                        }
                        else
                        {
                            $attendance->status = "اجازة";
                        }
                    }

                    else {
                        $attendance->status = "عطلة" ;   
                    }
                    $attendance->save();
                        
                                Log::info('Attendance check completed.');
                }
   }

}