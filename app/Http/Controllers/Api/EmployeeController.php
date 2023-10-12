<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Worktime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function show(Request $request)
    {
        // Retrieve the authenticated user
        $user = $request->user();
    
        // Check if the user has an associated employee
        $employee = $user->employee;

        $worktimes =  Worktime::where('employee_id',$employee->id)->select('work_start','work_end','is_vacation','weekday')->get();

        
foreach ($worktimes as $worktime) {
    // Format work_start and work_end
    $worktime->work_start = Carbon::parse($worktime->work_start)->format('h:i A');
    $worktime->work_end =   Carbon::parse($worktime->work_end)->format('h:i A');
}

            
        // If an employee is found, you can access its attributes
        if ($employee) {
            $user = $user->only(['id', 'name', 'email']); // Adjust the fields you want to include
    
            $data = [
                'user' => $user,
                'employee' => $employee,
                'worktime' => $worktimes
             
            ];
        } else {
            // If no employee is found, you can handle it accordingly
            // Return the user data only
            $data = [
                'user' => $user->only(['id', 'name', 'email']), // Adjust the fields you want to include
            ];
        }
    
        // Return the data
        return response()->json($data);
    }
    public function location(Request $request)  
    {
                // Validate the request
                $validateUser = Validator::make($request->all(), [
                    'employee_id' => 'required|integer',
                ]);
            
                if ($validateUser->fails()) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Validation error',
                        'errors' => $validateUser->errors()
                    ], 401);
                }

                        // Get the employee ID from the request
                $employeeId = $request->input('employee_id');
            
                // Check if the employee exists
                $employee = Employee::find($employeeId);
            
                if (!$employee) {
                    return response()->json(['error' => 'هذا الموظف غير موجود'], 404);
                }

                $branch = $employee->branche;

                return response()->json([
                    'status' => true,
                    'branch' => $branch
                ], 200);

    }
    public function monthDetails (Request $request)
    {
                // Validate the request
                $validateUser = Validator::make($request->all(), [
                    'employee_id' => 'required|integer',
                    'year' => 'required|integer',
                    'month' => 'required|integer|between:1,12', // Month should be between 1 and 12
                    // Optionally, you can validate that year and month together form a valid date:
                ]);
            
                if ($validateUser->fails()) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Validation error',
                        'errors' => $validateUser->errors()
                    ], 401);
                }

                        // Get the employee ID from the request
                $employeeId = $request->input('employee_id');
                $year = $request->input('year');
                $month = $request->input('month');
         
                // Check if the employee exists
                $employee = Employee::find($employeeId);
            
                if (!$employee) {
                    return response()->json(['error' => 'هذا الموظف غير موجود'], 404);
                }

                $attendances = Attendance::where('employee_id',$employeeId)->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->get();


                    $presentCount = $attendances->where('status', 'حاضر')->count();
                    $absentCount = $attendances->where('status', 'غائب')->count();
                    $vacationCount = $attendances->whereIn('status', ['عطلة', 'اجازة'])->count();
                    $IncompleteRecords =  $attendances->whereNull('leave')->count();
                    
                    return response()->json([
                        'status' => true,
                        'present_count' => $presentCount,
                        'absent_count' => $absentCount,
                        'vacation_count' => $vacationCount,
                        'incomplete_records' => $IncompleteRecords,
                    ], 200);

    }

    
}
