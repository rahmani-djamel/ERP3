<?php

namespace App\Livewire\Backend\Company\Vacation\AnnualHoliday;

use App\Models\AnnualHoliday;
use App\Models\Employee;
use App\Traits\Vacation\VacationTrait;
use Carbon\Carbon;
use Livewire\Component;
use Ramsey\Uuid\Rfc4122\VariantTrait;
use WireUi\Traits\Actions;

class Create extends Component
{
    use VacationTrait,Actions;
    public $employees;
    public $selected;
    public $jobNumber = '';
    public $vacationtypes;
    public $vacationdays;
    public $start;
    public $end;
    public $type;
    public $reset = 0;
    public $diffrence = 0;
    public $afterReduce = 0;

    public function rules()
    {
        return [
            'jobNumber' => 'required',
            'selected' => 'required',
            'vacationdays' => 'required',
            'start' => 'required',
            'end' => 'required',
            'type' => 'required'

        ];
    }

    public function mount()
    {
        $this->vacationtypes = $this->Vacation_type();
        $this->employees = Employee::with('annualholiday')->get();

    }

    public function save ()
    {

        $this->validate();

        $this->start = (gettype($this->start) !== "string") ? Carbon::parse($this->start) : $this->start;
      //  $this->end = (gettype($this->end) !== "string") ? Carbon::parse($this->end) : $this->end;

      //  dd($this->start,$this->end);
        
        if (Carbon::parse($this->end)->gt($this->start)) {

            //dd($this->selected);

            $checker = $this->Checker($this->start,$this->end,$this->selected);

          //  dd($checker);
            if (!is_array($checker)) {


                $holiday = new AnnualHoliday();
                $holiday->employee_id = $this->selected;
                $holiday->start_date = $this->start;
                $holiday->end_date = $this->end;
                $holiday->type = $this->type;
                $holiday->vacationtype_id = $this->type;
                $holiday->save();

                $this->dialog()->success(
                    $title = ' تمت الإضافة',
                    $description = 'تمت الاضافة بنجاح'
                );
              
            } else {
                $this->dialog()->error(
                    $title = ' خطأ',
                    $description = $checker['error']
                );
            }
            
            //  
            
      



                 
           }else{
            $this->dialog()->error(
                $title = ' خطأ',
                $description = 'وقت البداية اكبر من وقت النهاية'
            );
           }
    }


    public function updating($property,$value)
    {
        if ($property === 'selected') {
            $employee = $this->employees->firstWhere('id', $value);
            $this->jobNumber = $employee->JobNumber;
            $this->vacationdays = $employee->VacationDays + $employee->VacationSalary;
            // caluclate the reset 
            $holidays = $employee->annualholiday;

            $totalHolidayDuration = 0;

            foreach ($holidays as $holiday) {
               
                if ($holiday->vacationtype->is_reducable == 1) {
                   
                    
                    $startDate = Carbon::parse($holiday->start_date);
                    $endDate = Carbon::parse($holiday->end_date);

                    // Calculate the difference in days
                    $duration = $endDate->diffInDays($startDate);

                    $totalHolidayDuration += $duration;

                    if ($holiday->extend != 0) {
                        $totalHolidayDuration += $holiday->extend_days;
                    }
                }
            }
            $this->reset = ($this->vacationdays) - $totalHolidayDuration;
        }

        if ($property === 'start' || $property === 'end') {
            $this->{$property} = $value;

            if ($this->start != null && $this->end != null) {
                $this->start = Carbon::parse($this->start);
                $this->end = Carbon::parse($this->end);

               if ($this->end->gt($this->start)) {
                //  
                  $this->diffrence = (string) $this->end->diffInDays($this->start);
                  $this->afterReduce =  $this->reset - $this->diffrence;
                   //  dd($this->afterReduce);
               }else{
                $this->dialog()->error(
                    $title = ' خطأ',
                    $description = 'وقت البداية اكبر من وقت النهاية'
                );
               }
            }
        }
    }
    public function render()
    {
        return view('livewire.backend.company.vacation.annual-holiday.create');
    }
}
