<?php

namespace App\Livewire\Backend\Owner\Companies;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.backend.owner.companies.index')->layout('layouts.employee');
    }
}
