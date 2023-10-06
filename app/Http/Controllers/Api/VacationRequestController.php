<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnnualHoliday;
use App\Models\Setting;
use App\Models\VacationRequest;
use App\Traits\Vacation\VacationTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VacationRequestController extends Controller
{
    public function create(Request $request)
    {
        $validateUser = Validator::make($request->all(), 
        [
            'employee_id' => 'required|integer',
            'title' => 'required|string|min:3|max:255', // Minimum 3 characters and maximum 255 characters
            'description' => 'required|string|min:10|max:1500', // Minimum 10 characters and maximum 1000 characters
            'start_date' => ['required', 'date', 'date_format:Y-m-d'],
            'end_date' => ['required', 'date', 'date_format:Y-m-d'],
        ]);

        if($validateUser->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        $employeeId = $request->input('employee_id');
        $title = $request->input('title');
        $description = $request->input('description');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');



        $validation = $this->Checker($start_date,$end_date,$employeeId);

        if ($validation['status'] == false) {
            return response()->json([
                $validation
             
            ], 200);
        }

 



        
        // Validation passed, create an instance of VacationRequest
        $vacationRequest = new VacationRequest();
        $vacationRequest->employee_id = $request->input('employee_id');
        $vacationRequest->title = $request->input('title');
        $vacationRequest->description = $request->input('description');
        $vacationRequest->start_date = $start_date;
        $vacationRequest->end_date = $end_date;

        // Save the instance to the database
        $vacationRequest->save();

        // Return a success response
        return response()->json([
            'status' => true,
            'message' => 'Vacation request created successfully',
            'data' => $vacationRequest
        ], 201); // 201 status code indicates a resource was successfully created
        
    }

    public function Checker($start, $end,$employee = 0)
    {
        $startDate = Carbon::parse($start);
        $endDate = Carbon::parse($end);
    
        $differenceInDays = $startDate->diffInDays($endDate);

        

        $setting = Setting::first();
       // dd($differenceInDays, $setting->MinVacationDays);
    
        if ($differenceInDays < $setting->MinVacationDays) {
            $error = "عدد الايام الإجازة يجب ان لا يقل عن"."  ".$setting->MinVacationDays." ايام ";

            return [
                'status' => false,
                'error' => $error
            ];
        }  else {
            $employeeCount = AnnualHoliday::where(function ($query) use ($startDate, $endDate) {
                $query->whereDate('start_date', '>=', $startDate)
                      ->whereDate('end_date', '<=', $endDate);
            })->count();
    
            if ($employeeCount < $setting->MaximumVacationEmployees) {
                
            } else {
                $error = "عدد الموظفين في الفترة المحددة"."  ".$setting->MaximumVacationEmployees." موظف ";

                return [
                    'status' => false,
                    'error' => $error
                ];
            }
        }
        if ($employee != 0) 
        {
            $holidaysInRange = AnnualHoliday::where('employee_id', $employee)
                ->where(function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('start_date', [$startDate, $endDate])
                        ->orWhereBetween('end_date', [$startDate, $endDate]);
                })
                ->get();

                if (!$holidaysInRange->isEmpty()) {

                          // Process the holidays that are in the given date range.
                          $error = "الموظف في إجازة خلال الفترة المحددة";
                          return [
                              'status' => false,
                              'error' => $error
                          ];
  
                } 

                $holidaysInRange = AnnualHoliday::where('employee_id', $employee)->get();


                foreach ($holidaysInRange as $holiday) {
                    $holidayEndDate = \Carbon\Carbon::parse($holiday->end_date);
                    $daysDifference = $holidayEndDate->diffInDays($endDate);
                
                    if ($daysDifference < $setting->PeriodBetweenTwoVacations) {
                        // Handle the case where the end date is not at least 14 days after a holiday.
                        $error = "الموظف يجب أن يكون متاحا للعمل لمدة ".$setting->PeriodBetweenTwoVacations." يومًا بعد نهاية الإجازة.";
                        return [
                            'status' => false,
                            'error' => $error
                        ];
                    }
                }



        }
        return   [
            'status' => true,
        ];
  
    }
}
