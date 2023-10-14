<?php

namespace App\Livewire\Backend\Employee\AskPermission;

use App\Models\AskPermission;
use Carbon\Carbon;
use Livewire\Attributes\Rule;
use Livewire\Component;
use WireUi\Traits\Actions;

class Index extends Component
{
    use Actions;
       // Define the validation rules using #[Rule]
    #[Rule('required|date')]
    public $date;

    #[Rule('required|date_format:H:i')]
    public $start_time;

    #[Rule('required')]
    public $duration;

    #[Rule('required|string|max:800|min:15')]
    public $justification;


    public function save()
    {
        $this->validate();

        $permission = new AskPermission();
        $permission->date = Carbon::parse($this->date);
        $permission->start_time = $this->start_time;
        $permission->duration = $this->duration;
        $permission->justification = $this->justification;
        $permission->employee_id = auth()->user()->employee->id;
        $permission->save();

        $this->dialog([
            'title'       => __('sucess'),
            'description' => __('The request has been sent successfully'),
            'icon'        => 'success',
            'close'      => [
                'label'  => __('Ok')
            ],
        ]);

        $this->reset();

    }



    public function render()
    {
        return view('livewire.backend.employee.ask-permission.index')->layout('layouts.employee');
    }
}
