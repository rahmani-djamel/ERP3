<?php

namespace App\Livewire\Backend\Owner\Companies;

use App\Models\Company;
use App\Models\Package;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;
use WireUi\Traits\Actions;

class Edit extends Component
{
    use Actions;

    public Company $company;

    #[Rule('boolean')]
    public $is_trial = false;

   #[Rule('required|max:255')]
    public $Name;

   #[Rule('required|max:255')]
    public $owner_name;

   #[Rule('required|numeric')]
    public $phone;

    #[Rule('required|email')]
    public $email;

    #[Rule('required|max:255|exists:packages,id')]
    public $package;

    #[Rule('nullable','numeric','min:1')]
    public $days = 1;

    #[Rule('required')] 
    public $N_Employee;
    #[Rule('required')]
    public $N_Adminstrators;
    #[Rule('required')] 
    public $N_Branches;

    public $user;
    public $package_name;

    public function mount()
    {

            $this->Name = $this->company->name;
            $this->user = $this->company->owner;

            $this->owner_name = $this->user->name;
            $this->phone = $this->company->phone;
            $this->email = $this->user->email;
            $this->package = $this->company->package->id;
            $this->package_name = $this->company->package->name;
            $this->is_trial = $this->company->Testing_period != 0 ? true : false;
            $this->days = $this->company->days;
            //
            $this->N_Employee = $this->company->N_Of_Emps;
            $this->N_Adminstrators = $this->company->N_Of_Adminstrative;
            $this->N_Branches = $this->company->N_branches;
            
     

    }
    public function save()
    {
        try {
          //  dd($this->days,$this->is_trial);
            $this->validate();
            
            DB::beginTransaction(); // Start a database transaction
            
            $user = $this->user;

            $user->name = $this->owner_name;

            $this->validate([ 
                'email' => 'unique:users,email,'.$user->id
            ]);
            $user->email = $this->email;
            $user->save();
            

            
            $company = $this->company;
            $company->name = $this->Name;
            $company->user_id = $user->id;
            $company->package_id = $this->package; //error
            $company->phone = $this->phone;

            $company->N_Of_Emps	 = $this->N_Employee;
            $company->N_Of_Adminstrative = $this->N_Adminstrators;
            $company->N_branches = $this->N_Branches;
            
            if ($this->is_trial) {
                $company->days = $this->days; // Replace with your logic for days
                $company->Testing_period = 1; // Default value
            } else {
                $company->days = Package::findOrFail($this->package)->days; // Replace with your logic for days
                $company->Testing_period = 0; // Default value
            }
            
            $company->save();
            
            DB::commit(); // Commit the transaction
            
            $this->dialog()->success(
                $title = __('Added successfully'),
                $description = __('Company added successfully')
            );
            
            return redirect()->route('owner.dashboard.companies.index');

        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction in case of an exception
            dd($e); // Dump the error for debugging
        }
    }
    public function render()
    {
        return view('livewire.backend.owner.companies.edit')->layout('layouts.employee');
    }
}
