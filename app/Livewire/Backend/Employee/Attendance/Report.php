<?php

namespace App\Livewire\Backend\Employee\Attendance;

use App\Models\Attendance;
use Carbon\Carbon;
use Livewire\Component;

class Report extends Component
{
    public $employee;
    public $month;
    public $year;
    public $date;
    public $attendances;


    public function mount()
    {
        $now = Carbon::now();
        $this->year = $now->year;
        $this->month = $now->month;

        $this->employee = auth()->user()->employee;
        $this->filterAttendance($this->year,$this->month);
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
        $this->attendances = Attendance::where('employee_id',$this->employee->id)->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->get();

    }

    public function render()
    {
        return view('livewire.backend.employee.attendance.report')->layout('layouts.employee');
    }
}
