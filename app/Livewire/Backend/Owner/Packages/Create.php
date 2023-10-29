<?php

namespace App\Livewire\Backend\Owner\Packages;

use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.backend.owner.packages.create')->layout('layouts.employee');
    }
}
