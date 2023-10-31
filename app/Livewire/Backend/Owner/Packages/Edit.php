<?php

namespace App\Livewire\Backend\Owner\Packages;

use App\Models\Package;
use App\Traits\Lang\LangTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use WireUi\Traits\Actions;

class Edit extends Component
{
    use Actions, LangTrait;
    public Package $package;

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

    public function mount()
    {
        $this->Name = $this->GetWord($this->package->name);
        $this->price = $this->package->price;
        $this->days = $this->package->days;
        $this->N_Employee = $this->package->N_Of_Emps;
        $this->N_Adminstrators = $this->package->N_Of_Adminstrative;
        $this->N_Branches = $this->package->N_branches;

        $this->Name_English = $this->package->name;
    }
    public function save()
    {
        $this->validate();

        //dd($this->package->name,$this->Name_English,$this->Name);
        $this->EditWord($this->package->name,$this->Name_English,$this->Name);


        $package = $this->package;
        $package->name = $this->Name_English;
        $package->price = $this->price;
        $package->days = $this->days;
        $package->N_Of_Emps	 = $this->N_Employee;
        $package->N_Of_Adminstrative = $this->N_Adminstrators;
        $package->N_branches = $this->N_Branches;

        

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
        return view('livewire.backend.owner.packages.edit')->layout('layouts.employee');
    }
}
