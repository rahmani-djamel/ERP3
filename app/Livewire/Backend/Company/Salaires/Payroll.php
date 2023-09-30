<?php

namespace App\Livewire\Backend\Company\Salaires;

use App\Models\Employee;
use App\Traits\Salaires\SalairesTrait;
use Livewire\Component;

class Payroll extends Component
{
    use SalairesTrait;
    public $headers;
    public $data;

    public function mount()
    {
        $this->headers = $this->header();
        $this->data = Employee::all();

    }
    public function render()
    {
        return view('livewire.backend.company.salaires.payroll');
    }
}
