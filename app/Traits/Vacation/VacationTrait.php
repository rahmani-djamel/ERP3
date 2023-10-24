<?php

namespace App\Traits\Vacation;

use App\Models\AnnualHoliday;
use App\Models\Employee;
use App\Models\Setting;
use Carbon\Carbon;

trait VacationTrait
{
    public function Checker($start, $end,$employee = 0)
    {
        $startDate = $start;
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
        return true;
  
    }

    public function header()
    {
      return  $columnMapping = [
            'weekday' => 'the week',
            'work_start' => 'Start Time',
            'work_end' => 'End Time',
        ];
        
        
    }
    public function body()
    {
       return $columnMap = [
            'weekday',
            'work_start',
            'work_end',

        ];
    }
    public function Vacation_type()
    {
        return $options = [
            "أجازة عادية للسعوديين",
            "الإجازة العادية - غياب بعذر",
            "إجازة الوفاة",
            "أجازة إضطرارية للسعوديين",
            "الإجازة المرضية",
            "إجازة مرافقة مريض",
            "الإجازة الإستثنائية",
            "إجازة إستثنائية للمرافقة",
            "إجازة الامتحان الدراسي",
            "إجازة الأبوة",
            "إجازة تعويض تأخير",
            "إجازة وقوع كارثة",
            "إجازة ثقافية داخلية",
            "إجازة ثقافية خارجية",
            "المشاركة في أعمال الإغاثة",
            "إجازة غسيل فشل كلوي",
            "إجازة رياضية داخلية",
            "إجازة رياضية خارجية",
            "إجازة مرضية بسبب مرض خطير"
        ];
        

    }



}