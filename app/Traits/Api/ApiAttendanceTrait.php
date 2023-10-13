<?php

namespace App\Traits\Api;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Worktime;
use Carbon\Carbon;

trait ApiAttendanceTrait
{

    public function apidelay($att,$dayOfWeek,$employeeId)
    {

        
        // Find the most recent attendance record for the employee
        $attendance = $att;
    
        // Get the day of the week and date from the attendance record
        $dayOfWeek = Carbon::parse($attendance->attendance_date)->translatedFormat('l');
        $createdAt = $attendance->created_at;


        // Find the corresponding Worktime record for the same employee and day of the week
        $worktime = Worktime::where('employee_id', $employeeId)
            ->where('weekday', $dayOfWeek)
            ->first();
    
        if (!$worktime) {
            return [
                'status' => false,
                'message' => 'No worktime record found for this employee and day of the week',
            ];
        }

  
        // Calculate the delay (difference between attendance created_at and start_work)
        $startWork = Carbon::parse($worktime->work_start)->format('H:i:s');
        $createdAt = Carbon::parse($attendance->created_at)->format('H:i:s');
        $startWorkTime = Carbon::parse($startWork);
        $createdAtTime = Carbon::parse($createdAt);

        if ($createdAtTime < $startWorkTime) {
            // If created_at is less than start_work, store the delay as a negative value
            $delay = -$createdAtTime->diffInMinutes($startWorkTime);
        } else {
            $delay = $createdAtTime->diffInMinutes($startWorkTime);
        }

        $attendance->delay = $delay;

        $attendance->save();
    
        return [
            'status' => true,
            'message' => 'تم تسجيل الحضور',
            'start_work' => $startWork,
            'created' => $createdAt, 
            'delay_minutes' => $delay,
        ];

    }

}