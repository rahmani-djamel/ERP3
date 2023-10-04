<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    
}
