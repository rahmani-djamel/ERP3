<?php

namespace App\Livewire\Backend\Owner\Companies;

use Livewire\Component;

class Create extends Component
{
    public $is_trial = false;

    public function updating($key,$value)
    {

      //  dd($key,$value);
    }

    public function render()
    {
        return view('livewire.backend.owner.companies.create')->layout('layouts.employee');
    }
}
