<?php

namespace App\Livewire\Backend\Company\Employee;

use App\Traits\Employee\EmpTrait;
use Livewire\Component;

class Index extends Component
{
    use EmpTrait;

    public function render()
    {
        return view('livewire.backend.company.employee.index');
    }
}
