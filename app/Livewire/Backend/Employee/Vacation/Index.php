<?php

namespace App\Livewire\Backend\Employee\Vacation;

use App\Models\VacationRequest;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $employee;

    public $month;
    public $year;
    public $date;
    public $vacations;

    public function mount()
    {
        $now = Carbon::now();
        $this->year = $now->year;
        $this->month = $now->month;

        $this->employee = auth()->user()->employee;

        $this->filterVacations($this->year,$this->month);

    }

    public function filterVacations($year,$month)
    {
        $this->vacations = VacationRequest::where('employee_id',$this->employee->id)->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->get();

    }

    public function render()
    {
        return view('livewire.backend.employee.vacation.index')->layout('layouts.employee');
    }
}
