<?php

namespace App\Livewire\Backend\Owner\Packages;

use App\Models\Package;
use App\Traits\Lang\LangTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use WireUi\Traits\Actions;

class Create extends Component
{
    use Actions,LangTrait;

    #[Rule('required|min:3')] 
    public $Name;
    #[Rule('required|min:3')] 
    public $Name_English;
    #[Rule('required')] 
    public $price;
    #[Rule('required')] 
    public $days;
    #[Rule('required')] 
    public $N_Employee;
    #[Rule('required')]
    public $N_Adminstrators;
    #[Rule('required')] 
    public $N_Branches;

    public function save()
    {
        $this->validate();

        $package = new Package();
        $package->name = $this->Name_English;
        $package->price = $this->price;
        $package->days = $this->days;
        $package->N_Of_Emps	 = $this->N_Employee;
        $package->N_Of_Adminstrative = $this->N_Adminstrators;
        $package->N_branches = $this->N_Branches;

        $this->addToFile($this->Name_English,$this->Name);
        $package->save();



        $this->dialog()->success(
            $title = __('package saved'),
            $description = __('package saved successfully')
        );

        settings('packages',true);

         redirect()->route('owner.dashboard.packages.index');


        
     
    }

    public function render()
    {
        return view('livewire.backend.owner.packages.create')->layout('layouts.employee');
    }
}
