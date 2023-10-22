<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Branche;
use App\Models\Employee;
use App\Models\Worktime;
use App\Traits\Api\ApiAttendanceTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    use ApiAttendanceTrait;

    public function mark(Request $request)
    {
        $validateUser = Validator::make($request->all(), [
            'employee_id' => 'required|integer',
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
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
        $lat = $request->input('lat');
        $long = $request->input('long');
    
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

        $branche = Branche::findorfail($employee->branch_id);

        $distance = $this->distance($branche->lat,$branche->long,$lat,$long,'M');

        
        if ($distance > 50) {
            return response()->json([
                'status' => false,
                'distance' => $distance." M",
                'error' => 'انت خارج الشركة'
            ], 400);
        }
    
        // Record the attendance in the Attendance table
        $attendance = new Attendance();
        $attendance->employee_id = $employee->id;
        $attendance->status = 'حاضر';
        $attendance->day_of_week = $dayOfWeek;
        $attendance->attendance_date = $date;
        $attendance->save();

        $delay = $this->apidelay($attendance,$dayOfWeek,$employeeId);
    
        return response()->json($delay, 200);
    }
    public function leave(Request $request)
    {
        $validateUser = Validator::make($request->all(), 
        [
            'employee_id' => 'required|integer', // Adjust validation rules as needed
            'lat' => 'required|numeric',
            'long' => 'required|numeric',

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
        $lat = $request->input('lat');
        $long = $request->input('long');
    
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

        $branche = Branche::findorfail($employee->branch_id);

        $distance = $this->distance($branche->lat,$branche->long,$lat,$long,'M');

        
        if ($distance > 50) {
            return response()->json([
                'status' => false,
                'distance' => $distance." M",
                'error' => 'انت خارج الشركة'
            ], 400);
        }

        $existingAttendance->leave = now();
        $existingAttendance->save();

        return response()->json(['message' => 'تم تسجيل الإنصراف'], 200);

    }

    public function delay(Request $request)
    {

        
    
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
    
      
    
        return response()->json([
            'status' => true,
            'message' => 'تم حساب  فرق التأخير',
            'created_at' => $attendance->created_at, 
            'delay_minutes' => $attendance->delay,
        ], 200);
    }

    public function report(Request $request)
    {
        $validateUser = Validator::make($request->all(), 
        [
            'employee_id' => 'required|integer', // Adjust validation rules as needed
            'start_date' => ['required', 'date', 'date_format:Y-m-d'],
            'end_date' => ['required', 'date', 'date_format:Y-m-d'],
            'status' => ['nullable', 'in:حاضر,غائب'],
        ]);

        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        // If validation passes, proceed to fetch and process data
        $employeeId = $request->input('employee_id');
        $startDate = $request->input('start_date');
        $endDate = Carbon::parse($request->input('end_date'))->addDay(); // Add a day to the end date
        $status = $request->input('status'); // Get the status from the request

        // Fetch data from the database (you may need to adjust this part)
        // Fetch data from the database (you may need to adjust this part)
        $query = Attendance::where('employee_id', $employeeId)
            ->whereBetween('created_at', [$startDate, $endDate]);

        if (!empty($status)) {
            $query->where('status', $status);
        }

        $reportData = $query->get(['attendance_date', 'day_of_week', 'status', 'created_at', 'delay']);


        // Process the report data as needed

        // Return a JSON response with the report data
        return response()->json([
            'status' => true,
            'message' => 'Report data retrieved successfully',
            'data' => $reportData
        ], 200);

    }

}
