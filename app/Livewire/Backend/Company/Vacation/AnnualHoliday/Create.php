<?php

namespace App\Livewire\Backend\Company\Vacation\AnnualHoliday;

use App\Models\Employee;
use Livewire\Component;

class Create extends Component
{
    public $employees;
    public $selected;
    public $jobNumber = '';
    public function mount()
    {
        $this->employees = Employee::all();

    }

    public function updated($property)
    {
        if ($property === 'selected') {
            $employee = $this->employees->firstWhere('id', $this->selected);
            $this->jobNumber = $employee->JobNumber;

         //   dd($this->jobNumber);
        }
    }
    public function render()
    {
        return view('livewire.backend.company.vacation.annual-holiday.create');
    }
}
