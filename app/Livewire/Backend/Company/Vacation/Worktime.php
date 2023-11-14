<?php

namespace App\Livewire\Backend\Company\Vacation;

use App\Models\Employee;
use App\Traits\Vacation\VacationTrait;
use Livewire\Component;

class Worktime extends Component
{
    use VacationTrait;

    public $selected= [];
    public $search='';

    public function mount()
    {

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
    public function selection($item)
    {
        $this->selected = $item;

     //   dd($this->selected);


    }
    public function render()
    {
        return view('livewire.backend.company.vacation.worktime',[
            'employees' => Employee::search($this->search)->where('company_id',$this->company()->id)->get()
        ]
    );
    }
}
