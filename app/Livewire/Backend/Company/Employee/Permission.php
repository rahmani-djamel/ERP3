<?php

namespace App\Livewire\Backend\Company\Employee;

use App\Models\Employee;
use Livewire\Attributes\Rule;
use Livewire\Component;
use WireUi\Traits\Actions;

class Permission extends Component
{
    use Actions;
    public Employee $employee;

   #[Rule('required|array|min:1')]
    public $permissions = [];

    public function mount()
    {
        $this->permissions = $this->employee->user->permissions->pluck('id')->toArray();

       // dd($this->permissions);


        $obj = [];
        foreach ($this->permissions as $value) {
          $obj[$value] = true;
        }

        $this->permissions =  ($obj);
    }

    public function save()
    {
        $this->validate();


        
        $keys = collect($this->permissions)
        ->filter(function ($value) {
            return $value === true;
        })
        ->keys()
        ->toArray();

        $this->employee->user->permissions()->detach();
        $this->employee->user->syncPermissions($keys);

  
        $this->dialog()->show([
            'title'       => __('User permissions'),
            'description' => __('User permissions have been modified successfully'),
            'icon'   => 'success',
            'close'      => [
                'label'  => __('Ok')
            ],
           

        ]);

    }

    
    public function render()
    {
        return view('livewire.backend.company.employee.permission');
    }
}
