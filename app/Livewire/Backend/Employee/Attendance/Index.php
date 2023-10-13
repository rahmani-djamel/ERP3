<?php

namespace App\Livewire\Backend\Employee\Attendance;

use App\Models\Attendance;
use App\Traits\Api\ApiAttendanceTrait;
use Carbon\Carbon;
use Livewire\Component;
use WireUi\Traits\Actions;

class Index extends Component
{
    use Actions,ApiAttendanceTrait;
    public $employee;

    public function mount()
    {
        $this->employee = auth()->user()->employee;
    }
    public function save()
    {
        $dayOfWeek = Carbon::now()->translatedFormat('l');
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
        $attendance->status = 'حاضر';
        $attendance->day_of_week = $dayOfWeek;
        $attendance->attendance_date = $date;
        $attendance->save();


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
    public function render()
    {
        return view('livewire.backend.employee.attendance.index')->layout('layouts.employee');
    }
}
