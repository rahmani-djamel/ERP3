<?php

namespace App\Livewire\Backend\Owner;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.backend.owner.index')->layout('layouts.employee');
    }
}
