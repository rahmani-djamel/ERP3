<?php

namespace App\Livewire\Backend\Employee\Information;

use App\Traits\DashboardEmployee\EmpInformationTrait;
use Livewire\Component;

class Index extends Component
{
    use EmpInformationTrait;
    public $employee;
    public $header;
    public $information;

    public function mount()
    {
        $this->employee = auth()->user()->employee;
        $this->header = $this->header();
        //dd($this->employee);
    }
    public function render()
    {
        return view('livewire.backend.employee.information.index')->layout('layouts.employee');
    }
}
