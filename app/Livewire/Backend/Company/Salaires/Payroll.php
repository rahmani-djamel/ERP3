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
        $company = $this->company();
        $this->headers = $this->header();
        $this->data = Employee::where('company_id',$company->id)->get();

    }
    public function company()
    {
        $user = auth()->user();

        if ($user->hasRole('manger')) {
           return $user->company;
        } else {
            return $user->employee->company;
        }
    }
    public function render()
    {
        return view('livewire.backend.company.salaires.payroll');
    }
}
