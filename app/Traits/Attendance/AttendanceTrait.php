<?php

namespace App\Traits\Attendance;

use App\Models\Employee;
use Carbon\Carbon;

trait AttendanceTrait
{

    

public  function ReportByWeek($date = null,$branche = null)
{

    if ($date == null) {
        $now = Carbon::today(); // Get today's date

    } else {
        $now = Carbon::parse($date);
    }
    

    $now->startOfWeek(Carbon::SATURDAY); // Set Saturday as the start of the week
    $endOfWeek = $now->copy()->endOfWeek(Carbon::FRIDAY); // Set Friday as the end of the week
    
    $startOfWeekFormatted = $now->format('Y-m-d'); // Example format for the start of the week
    $endOfWeekFormatted = $endOfWeek->format('Y-m-d'); // Example format for the end of the week

    $company = 0;

    if (auth()->user()->hasRole('manger')) {
        # code...
        $company = auth()->user()->company->id;
    } else {
        # code...
        $company = auth()->user()->employee->company_id;

    }
    

    

    $employees = Employee::where('company_id',$company)->with(['attendances' => function ($query) use ($startOfWeekFormatted, $endOfWeekFormatted) {
        $query->whereBetween('attendance_date', [$startOfWeekFormatted, $endOfWeekFormatted]);
    }]);

        // Check if a specific branch ID is provided
        if ($branche !== null) {
            $employees->where('branch_id', $branche);
        }
    


    $employees = $employees->get();





    $formattedEmployees = $employees->map(function ($employee) use ($startOfWeekFormatted, $endOfWeekFormatted) {
        $days = [
            'Saturday' => (object)['status' => 'لم يحدد', 'id' => null], // Default value for Saturday
            'Sunday' => (object)['status' => 'لم يحدد', 'id' => null],   // Default value for Sunday
            'Monday' => (object)['status' => 'لم يحدد', 'id' => null],   // Default value for Monday
            'Tuesday' => (object)['status' => 'لم يحدد', 'id' => null],  // Default value for Tuesday
            'Wednesday' => (object)['status' => 'لم يحدد', 'id' => null], // Default value for Wednesday
            'Thursday' => (object)['status' => 'لم يحدد', 'id' => null],  // Default value for Thursday
            'Friday' => (object)['status' => 'لم يحدد', 'id' => null],    // Default value for Friday
        ];
    
        foreach ($employee->attendances as $attendanceRecord) {
            $attendanceDate = Carbon::parse($attendanceRecord->attendance_date);
            $dayName = $attendanceDate->format('l'); // Get the full day name (e.g., Saturday, Sunday, etc.)
    
            // Update the day object with 'status' and 'id'
            $days[$dayName]->status = __($attendanceRecord->status);
            $days[$dayName]->id = $attendanceRecord->id;
        }
    
        return [
            'id' => $employee->id,
            'number' => $employee->JobNumber,
            'name' => $employee->Name,
            'attendance' => $employee->attendance,
            'branch' => $employee->branch_id,
            'days' => $days,
        ];
    });
    
    

   return  $responseData = [
        'startWeek' => $startOfWeekFormatted,
        'endWeek' => $endOfWeekFormatted,
        'formattedEmployees' => $formattedEmployees,
    ];
    
  }

}
