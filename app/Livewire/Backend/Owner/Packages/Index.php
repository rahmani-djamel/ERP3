<?php

namespace App\Livewire\Backend\Owner\Packages;

use Illuminate\Support\Facades\File;
use Livewire\Component;

class Index extends Component
{
    public $packages;

    
    public function mount()
    {


    }
    public function render()
    {
        return view('livewire.backend.owner.packages.index')->layout('layouts.employee');
    }
}
