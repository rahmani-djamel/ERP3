<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function show(Request $request) 
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
        $absent = Attendance::where('employee_id', $employee->id)
        ->where('status', 'غائب')
        ->whereYear('attendance_date', $now->year)
        ->whereMonth('attendance_date', $now->month)
        ->count();
        

         $data = [
            'id' => $employee->id,
            'JobNumber' => $employee->JobNumber,
            'Name' => $employee->Name,
            'BasicSalary' => $employee->BasicSalary,
            'HousingAllowance' => $employee->HousingAllowance,
            'transportationAllowance' => $employee->transportationAllowance,
            'AbsentCount' => 0,
            'LateCount' => 0,
            'LoanHistory' => $employee->LoanHistory,
        ];
        
        return response()->json($data);


        
    }
}
