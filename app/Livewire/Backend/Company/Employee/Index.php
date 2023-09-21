<?php

namespace App\Livewire\Backend\Company\Employee;

use App\Models\Employee;
use App\Traits\Employee\EmpTrait;
use Livewire\Component;

class Index extends Component
{
    use EmpTrait;

    public  $headers = [];
    public $keysToDisplay = [];
    public $search ='';

    public function mount()
    {
        $this->headers = $this->header(); 
        $this->keysToDisplay = $this->body();
    }

    public function render()
    {
        return view('livewire.backend.company.employee.index',[
            'employees' => Employee::search($this->search)->get()
        ]);
    }
}
