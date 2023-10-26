<?php

namespace App\Livewire\Backend\Company\Employee;

use App\Models\Employee;
use App\Traits\Employee\EmpTrait;
use Livewire\Component;
use WireUi\Traits\Actions;

class Index extends Component
{
    use EmpTrait,Actions;

    public  $headers = [];
    public $keysToDisplay = [];
    public $search ='';
    public $key = "employee";
    public $deleteKey = 0;

    public function mount()
    {
        $this->headers = $this->header(); 
        $this->keysToDisplay = $this->body();
    }

    public function delete($item)
    {
        $this->deleteKey = $item['id'];

        if ($this->deleteKey != 0) {
            $employee = Employee::findorfail($this->deleteKey);

            $employee->delete();

            $this->dialog()->error(
                $title = __('Delete Employee'),
                $description = __('Employee deleted successfully')
            );
            

            $this->dispatch('refresh');
        } 
    }
  
    public function deleteItem()
    {
 
        
  
        dd($this->deleteKey);
    }

    public function render()
    {
        return view('livewire.backend.company.employee.index',[
            'employees' => Employee::search($this->search)->get()
        ]);
    }
}
