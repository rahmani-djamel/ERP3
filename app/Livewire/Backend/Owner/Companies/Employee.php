<?php

namespace App\Livewire\Backend\Owner\Companies;

use App\Models\Company;
use Livewire\Component;

class Employee extends Component
{
    public Company $company;
    public function mount()
    {

    }
    public function render()
    {
        return view('livewire.backend.owner.companies.employee')->layout('layouts.employee');
    }
}
