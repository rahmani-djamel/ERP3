<?php

namespace App\Livewire\Backend\Employee\Vacation;

use App\Models\AnnualHoliday;
use App\Models\Setting;
use App\Models\VacationRequest;
use Carbon\Carbon;
use Livewire\Component;
use WireUi\Traits\Actions;

class ModalCreate extends Component
{

    use Actions;
    
    public $description;
    public $title;
    public $start_date;
    public $end_date;
    public $employee;
    public $gt = false;

    public function rules()
    {
        return  [
            'title' => 'required|string|min:3|max:255', // Minimum 3 characters and maximum 255 characters
            'description' => 'required|string|min:10|max:1500', // Minimum 10 characters and maximum 1000 characters
            'start_date' => ['required', 'date', 'date_format:Y-m-d'],
            'end_date' => ['required', 'date', 'date_format:Y-m-d'],
        ];
    }

    public function mount()
    {
        $this->employee = auth()->user()->employee;
    }
    public function updating($property,$value)
    {

        if ($property === 'start' || $property === 'end') {
            $this->{$property} = $value;

            if ($this->start != null && $this->end != null) {
                $this->start_date = Carbon::parse($this->start_date);
                $this->end_date = Carbon::parse($this->end_date);

               if ($this->end->gt($this->start)) {
                
                $this->gt = true;

               }else{
                $this->gt = false;

                $this->dialog()->error(
                    $title = ' خطأ',
                    $description = 'وقت البداية اكبر من وقت النهاية'
                );
               }
            }
        }
    }
    public function save()
    {
        $this->validate();
       $checker =  $this->Checker($this->start_date,$this->end_date,$this->employee->id);

       if ($checker['status'] == false || $this->gt == false) {
        $this->dialog([
            'title'       => __($checker['status'] ),
            'description' => __('Something is wrong'),
            'icon'        => 'warning',
            'close'      => [
                'label'  => __('Ok')
            ],
        ]);
        return ;
    }

    // Validation passed, create an instance of VacationRequest
    $vacationRequest = new VacationRequest();
    $vacationRequest->employee_id = $this->employee->id;
    $vacationRequest->title = $this->title;
    $vacationRequest->description = $this->description;
    $vacationRequest->start_date = $this->start_date;
    $vacationRequest->end_date = $this->end_date;

    // Save the instance to the database
    $vacationRequest->save();

    $this->reset();

    
    $this->dialog()->show([
        'title'       => __('Record attendance'),
        'description' => __('Attendance has been registered successfully'),
        'icon'   => 'success',
        'close'      => [
            'label'  => __('Ok')
        ],
       

    ]);

    }
    public function render()
    {
        return view('livewire.backend.employee.vacation.modal-create');
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
