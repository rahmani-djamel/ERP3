<?php

namespace App\Livewire\Backend\Owner\Packages;

use Livewire\Component;

class Create extends Component
{
    public $Name;
    public $Name_English;
    public $price;
    public $days;
    public $N_Employee;
    public $N_Adminstrators;
    public $N_Branches;
    public function render()
    {
        return view('livewire.backend.owner.packages.create')->layout('layouts.employee');
    }
}
