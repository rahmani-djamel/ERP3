<?php

namespace App\Livewire\Backend\Employee\Attendance;

use App\Models\Attendance;
use App\Models\Worktime;
use App\Traits\Api\ApiAttendanceTrait;
use Carbon\Carbon;
use Livewire\Component;
use WireUi\Traits\Actions;

class Index extends Component
{
    use Actions,ApiAttendanceTrait;

    public $employee;
    public $absentCount;
    public $presentCount;
    public $IncompleteRecords;
    public $vacationCount;
    public $month;
    public $year;
    public $date;
    public $checker = 0;

    public function mount()
    {
        $now = Carbon::now();
        $this->year = $now->year;
        $this->month = $now->month;

        $this->employee = auth()->user()->employee;

        $this->filterAttendance($this->year,$this->month);

        $date = date('Y-m-d');


        // Check if attendance already exists for that employee and date
        $existingAttendance = Attendance::where('employee_id', $this->employee->id)
            ->where('attendance_date', $date)
            ->first();

        if ($existingAttendance) 
        {
            $this->checker = 1;
        }

    }
    public function updating($proprety,$value)
    {
        if ($proprety == "date") {
            $carbonDate = Carbon::parse($value);
            $this->year = $carbonDate->year;
            $this->month = $carbonDate->month;
            
            // You can use $year and $month for further processing.
            $this->filterAttendance($this->year,$this->month);
        }
    }
    public function filterAttendance($year,$month)
    {
        $attendances = Attendance::where('employee_id',$this->employee->id)->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->get();


        $this->presentCount = $attendances->where('status', 'Present')->count();
        $this->absentCount = $attendances->where('status', 'Absent')->count();
        $this->vacationCount = $attendances->whereIn('status', ['Vacance', 'اجازة'])->count();
        $this->IncompleteRecords =  $attendances->whereNull('leave')->count();

    }
    public function save()
    {
        $dayOfWeek = Carbon::now()->format('l');
        $date = date('Y-m-d');
    
        // Check if attendance already exists for that employee and date
        $existingAttendance = Attendance::where('employee_id', $this->employee->id)
            ->where('attendance_date', $date)
            ->first();
    
        if ($existingAttendance) {
            $this->dialog([
                'title'       => __('Record attendance'),
                'description' => __('Attendance has already been recorded'),
                'icon'        => 'warning',
                'close'      => [
                    'label'  => __('Ok')
                ],
            ]);
            return ;
        }
    
        // Record the attendance in the Attendance table
        $attendance = new Attendance();
        $attendance->employee_id = $this->employee->id;
        $attendance->status = 'Present';
        $attendance->day_of_week = $dayOfWeek;
        $attendance->attendance_date = $date;
        $attendance->save();

        $this->apidelay($attendance,$dayOfWeek,$this->employee->id);


        $this->dialog()->show([
            'title'       => __('Record attendance'),
            'description' => __('Attendance has been registered successfully'),
            'icon'   => 'success',
            'close'      => [
                'label'  => __('Ok')
            ],
           

        ]);
    }
    public function quit()
    {
        $date = date('Y-m-d');
        // Get the name of the day in Arabic
        $dayOfWeek = Carbon::today()->translatedFormat('l');

        $workTimeForToday =  Worktime::where('employee_id', $this->employee->id)
        ->where('weekday', $dayOfWeek)->first();

      //  dd($dayOfWeek);



        $endTime = Carbon::parse($workTimeForToday->work_end);
        $currentTime = Carbon::now();

         //

    
        if ($currentTime->lessThan($endTime)) {
            
            $this->dialog()->confirm([
                'title'       => __('Its not time to go out'),
                'description' => __('Do you want to ask permission ?'),
                'icon'        => 'question',
                'accept'      => [
                    'label'  => __('Yes,Ask permission'),
                    'method' => 'redirection',
                ],
                'reject' => [
                    'label'  => __('Going out without permission'),
                    'method' => 'cancel',
                ],
            ]);

        }
        else
        {
            $existingAttendance = Attendance::where('employee_id', $this->employee->id)
            ->where('attendance_date', $date)
            ->first();
    
            if (!$existingAttendance) 
            {
                $this->dialog([
                    'title'       => __('sign out'),
                    'description' => __('Attendance has not been recorded previously'),
                    'icon'        => 'warning',
                    'close'      => [
                        'label'  => __('Ok')
                    ],
                ]);
                return ;
            }
    
            $existingAttendance->leave = now();
            $existingAttendance->save();
    
            $this->dialog()->show([
                'title'       => __('sign out'),
                'description' => __('The checkout has been registered successfully'),
                'icon'   => 'success',
                'close'      => [
                    'label'  => __('Ok')
                ],
               
    
            ]);

        }


      

    }
    public function cancel()
    {
        $date = date('Y-m-d');

        $existingAttendance = Attendance::where('employee_id', $this->employee->id)
        ->where('attendance_date', $date)
        ->first();

        if (!$existingAttendance) 
        {
            $this->dialog([
                'title'       => __('sign out'),
                'description' => __('Attendance has not been recorded previously'),
                'icon'        => 'warning',
                'close'      => [
                    'label'  => __('Ok')
                ],
            ]);
            return ;
        }

        $existingAttendance->leave = now();
        $existingAttendance->save();

        $this->dialog()->show([
            'title'       => __('sign out'),
            'description' => __('The checkout has been registered successfully'),
            'icon'   => 'success',
            'close'      => [
                'label'  => __('Ok')
            ],
           

        ]);

    }
    public function redirection()
    {
        return redirect()->route('employee.dashboard.askpermission.index');

    }
    public function render()
    {
        return view('livewire.backend.employee.attendance.index')->layout('layouts.employee');
    }
}
