<?php

namespace App\Livewire\Backend\Employee;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.backend.employee.index')->layout('layouts.employee');
    }
}
