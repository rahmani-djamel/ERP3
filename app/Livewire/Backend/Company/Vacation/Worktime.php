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
    public function selection($item)
    {
        $this->selected = $item;

     //   dd($this->selected);


    }
    public function render()
    {
        return view('livewire.backend.company.vacation.worktime',[
            'employees' => Employee::search($this->search)->get()
        ]
    );
    }
}
