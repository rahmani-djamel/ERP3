<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnnualHoliday;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VacationController extends Controller
{
    public function show(Request $request)
    {

        $validateUser = Validator::make($request->all(), 
        [
            'employee_id' => 'required|integer', // Adjust validation rules as needed

        ]);

        if($validateUser->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }
                        // Get the employee ID from the request
        $employeeId = $request->input('employee_id');
            
                // Check if the employee exists
        $employee = Employee::find($employeeId);
            
        if (!$employee) 
        {
            return response()->json(['error' => 'هذا الموظف غير موجود'], 404);
        }

        $holidays = AnnualHoliday::where('employee_id', $employeeId)->get();

        $totalHolidayDuration = 0; // Initialize a variable to store the total duration
        
        foreach ($holidays as $holiday) {
            $startDate = Carbon::parse($holiday->start_date);
            $endDate = Carbon::parse($holiday->end_date);
        
            // Calculate the difference in days (or other units) between the start and end dates
            $durationInDays = $startDate->diffInDays($endDate);
        
            // Add the duration of this holiday to the total
            $totalHolidayDuration += $durationInDays;
        }
        
        // $totalHolidayDuration now contains the sum of all holiday durations in days
        

        $vacation = (int) $employee->VacationSalary + (int) $employee->VacationDays;

        return response()->json([
            'status' => true,
            'total' => $vacation,
            'totalHolidayDuration' => $totalHolidayDuration,
            'VacationDaysLeft' => $vacation - $totalHolidayDuration
        ], 200);

    }
    public function report(Request $request)
    {

        $validateUser = Validator::make($request->all(), 
        [
            'employee_id' => 'required|integer', // Adjust validation rules as needed

        ]);

        if($validateUser->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

            // Get the employee ID from the request
        $employeeId = $request->input('employee_id');
            
                                // Check if the employee exists
        $employee = Employee::find($employeeId);
                            
        if (!$employee) 
        {
             return response()->json(['error' => 'هذا الموظف غير موجود'], 404);
        }
                
        $holidays = AnnualHoliday::where('employee_id', $employeeId)
        ->with('vacationtype')
        ->get();
    
        $holidays->transform(function ($holiday) {
            $holiday->type = $holiday->vacationtype->name;
            $holiday->Resumption = $holiday->end_date;
            unset($holiday->vacationtype, $holiday->created_at, $holiday->updated_at,$holiday->id,$holiday->vacationtype_id,$holiday->extend);
            return $holiday;
        });
        return response()->json([
            'status' => true,
            'data' => $holidays
        ], 200);

    }

}
