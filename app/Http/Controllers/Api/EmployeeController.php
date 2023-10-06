<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
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
    
        // If an employee is found, you can access its attributes
        if ($employee) {
            $user = $user->only(['id', 'name', 'email']); // Adjust the fields you want to include
    
            $data = [
                'user' => $user,
                'employee' => $employee,
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

    
}
