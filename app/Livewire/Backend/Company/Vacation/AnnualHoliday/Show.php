<?php

namespace App\Livewire\Backend\Company\Vacation\AnnualHoliday;

use App\Models\AnnualHoliday;
use App\Models\Employee;
use Livewire\Component;

class Show extends Component
{
    public $search = '';
    public function render()
    {
        return view('livewire.backend.company.vacation.annual-holiday.show',
        [
            'employees' => Employee::search($this->search)->get()
        ]);
    }
}
