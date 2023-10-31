<?php

namespace App\Livewire\Backend\Includes\Modals;

use App\Models\Package;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\Actions;

class Delete extends Component
{
    use Actions;
    public $open = false;
    public $data;

    public function render()
    {
        return view('livewire.backend.includes.modals.delete');
    }
}
