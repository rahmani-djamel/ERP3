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

class Create extends Component
{
    use Actions;

    #[Rule('boolean')]
    public $is_trial = false;

   #[Rule('required|max:255')]
    public $Name;

   #[Rule('required|max:255')]
    public $owner_name;

   #[Rule('required|numeric')]
    public $phone;

    #[Rule('required|email|unique:users,email')]
    public $email;

    #[Rule('required|max:255|exists:packages,id')]
    public $package;

    #[Rule('nullable','numeric','min:1')]
    public $days = 1;


    public function save()
    {
        try {
          //  dd($this->days,$this->is_trial);
            $this->validate();
            
            DB::beginTransaction(); // Start a database transaction

            $package = Package::findorfail($this->package);
            
            $user = new User();
            $user->name = $this->owner_name;
            $user->email = $this->email;
            $user->password = Hash::make('password');
            $user->save();
            
            $user->addRole(2);
            
            $company = new Company();
            $company->name = $this->Name;
            $company->user_id = $user->id;
            $company->package_id = $this->package; // Replace with your logic for package_id
            $company->phone = $this->phone;
            $company->N_Of_Emps	 = (int)$package->N_Of_Emps;
            $company->N_Of_Adminstrative = (int)$package->N_Of_Adminstrative;
            $company->N_branches = (int)$package->N_branches;
            
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
        return view('livewire.backend.owner.companies.create')->layout('layouts.employee');
    }
}
