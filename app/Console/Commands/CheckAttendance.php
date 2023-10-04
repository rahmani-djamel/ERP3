<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Console\Command;

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
                foreach ($absentEmployees as $employee) {
                    // Create an absent attendance record for each employee
                    Attendance::create([
                        'employee_id' => $employee->id,
                        'attendance_date' => $currentDate,
                        'status' => 'غائب',
                        'day_of_week' => $dayOfWeek
                    ]);
        
                    $this->info('Marked ' . $employee->name . ' as absent.');
                }
        
                $this->info('Attendance check completed.');
    }
}
