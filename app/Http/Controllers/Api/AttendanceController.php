<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Worktime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public function mark(Request $request)
    {
        $validateUser = Validator::make($request->all(), 
        [
            'employee_id' => 'required|integer', // Adjust validation rules as needed

        ]);

        if($validateUser->fails()){
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
    
        if (!$employee) {
            return response()->json(['error' => 'هذا الموظف غير موجود'], 404);
        }
    
        // Get the current day of the week and date
        // Set the Carbon locale to Arabic
 

        // Get the day of the week in Arabic
        $dayOfWeek = Carbon::now()->translatedFormat('l');
        $date = date('Y-m-d');
    
        // Check if attendance already exists for that employee and date
        $existingAttendance = Attendance::where('employee_id', $employee->id)
            ->where('attendance_date', $date)
            ->first();
    
        if ($existingAttendance) {
            return response()->json(['error' => 'تم تسجيل الحضور من قبل'], 400);
        }
    
        // Record the attendance in the Attendance table
        $attendance = new Attendance();
        $attendance->employee_id = $employee->id;
        $attendance->status = 'حاضر';
        $attendance->day_of_week = $dayOfWeek;
        $attendance->attendance_date = $date;
        $attendance->save();
    
        return response()->json(['message' => 'تم تسجيل الحضور'], 200);
    }
    public function leave(Request $request)
    {
        $validateUser = Validator::make($request->all(), 
        [
            'employee_id' => 'required|integer', // Adjust validation rules as needed

        ]);

        if($validateUser->fails()){
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
    
        if (!$employee) {
            return response()->json(['error' => 'هذا الموظف غير موجود'], 404);
        }
    
        // Get the current day of the week and date
        $date = date('Y-m-d');
    
        // Check if attendance already exists for that employee and date
        $existingAttendance = Attendance::where('employee_id', $employee->id)
            ->where('attendance_date', $date)
            ->first();
        if (!$existingAttendance) {
            return response()->json(['error' => 'لم يتم تسجيل الحضور من قبل'], 400);
        }

        $existingAttendance->leave = now();
        $existingAttendance->save();

        return response()->json(['message' => 'تم تسجيل الإنصراف'], 200);

    }
    public function delay(Request $request)
    {
        // Validate the request
        $validateUser = Validator::make($request->all(), [
            'employee_id' => 'required|integer',
            'date' => ['nullable', 'date', 'date_format:Y-m-d'],
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
        $date = $request->input('date', Carbon::today()->format('Y-m-d'));


    
        // Find the most recent attendance record for the employee
        $attendance = Attendance::where('employee_id', $employeeId)
            ->where('attendance_date',$date)
            ->orderBy('created_at', 'desc')
            ->first();
    
        if (!$attendance) {
            return response()->json([
                'status' => false,
                'message' => 'No attendance record found for this employee',
            ], 404);
        }
    
        // Get the day of the week and date from the attendance record
        $dayOfWeek = Carbon::parse($attendance->attendance_date)->translatedFormat('l');
        $createdAt = $attendance->created_at;


        // Find the corresponding Worktime record for the same employee and day of the week
        $worktime = Worktime::where('employee_id', $employeeId)
            ->where('weekday', $dayOfWeek)
            ->first();
    
        if (!$worktime) {
            return response()->json([
                'status' => false,
                'message' => 'No worktime record found for this employee and day of the week',
            ], 404);
        }

  
        // Calculate the delay (difference between attendance created_at and start_work)
        $startWork = Carbon::parse($worktime->work_start)->format('H:i:s');
        $createdAt = Carbon::parse($attendance->created_at)->format('H:i:s');
        $startWorkTime = Carbon::parse($startWork);
        $createdAtTime = Carbon::parse($createdAt);
        $delay = $createdAtTime->diffInMinutes($startWorkTime);
    
        return response()->json([
            'status' => true,
            'message' => 'تم حساب  فرق التأخير',
            'start' => $startWork,
             'created_at' => $createdAt, 
            'delay_minutes' => $delay,
        ], 200);
    }
}
