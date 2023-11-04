<?php

namespace App\Livewire\Backend\Company\Employee;

use App\Models\Branche;
use App\Models\Employee;
use App\Traits\Employee\EmpTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Create extends Component
{
    use WithFileUploads,EmpTrait,Actions;

    #[Rule('nullable|array')]
    public $files = '';

    #[Rule('nullable|mimes:jpeg,jpg,png,pdf|max:2048')]
    public $file = '';

    #[Rule('required|string|max:255')]
    public $Name = '';

    #[Rule('required|email|unique:employees,email')]
    public $email = '';

    #[Rule('required|string|max:255')]
    public $CarteNumber = '';

    #[Rule('required|string|max:255')]
    public $JobNumber = '';

    #[Rule('required|string|max:255')]
    public $Nationality = '';

    #[Rule('required|string|max:255')]
    public $Gender = '';

    #[Rule('required|date')]
    public $DateOfBirth = '';

    #[Rule('required|date')]
    public $Start_work;

    #[Rule('required|date')]
    public $End;

    #[Rule('required|string|max:20')]
    public $Phone = '';

    #[Rule('required|integer')]
    public $VacationDays = '';

    #[Rule('required|string|max:255')]
    public $ContratType = '';

    #[Rule('required|string|max:255')]
    public $Rating = '';

    #[Rule('required|string|max:255')]
    public $Status = '';

    #[Rule('nullable|string|max:255')]
    public $FriendName = '';

    #[Rule('nullable|string|max:20')]
    public $FriendPhone = '';

    #[Rule('nullable|string|max:255')]
    public $InsuranceClass = '';

    #[Rule('nullable|date')]
    public $InsuranceExpiryDate = '';

    #[Rule('nullable|string|max:255')]
    public $BankName = '';

    #[Rule('nullable|string|max:255')]
    public $BankNumber = '';

    #[Rule('required|string|max:255')]
    public $BasicSalary = '';

    #[Rule('required|string|max:255')]
    public $OtherAllowances = '';

    #[Rule('required|string|max:255')]
    public $InsuranceRatio = '';

    #[Rule('required|string|max:255')]
    public $InsuranceSubscriptionAmount = '';

    #[Rule('required|string|max:255')]
    public $HousingAllowance = '';

    #[Rule('required|string|max:255')]
    public $transportationAllowance = '';

    #[Rule('required|string|max:255')]
    public $VacationSalary = '';

    #[Rule('required|string|max:255')]
    public $DurationOfTheWarningPeriod = '';

    #[Rule('nullable|string|max:255')]
    public $LoanHistory = '';

    #[Rule('nullable|string|max:255')]

    public $CovenantRecord = '';

    #[Rule('required')]
    public $branch_id;

    #[Rule('required|in:0,1')]
    public $is_adminstaror = 0;

    public $user;
    public $company;
    public $package;
    public $counter_employees;
    public $counter_admins;
    public $branches;

    public function mount()
    {

        if (auth()->user()->hasRole('manger')) {

            $this->company = auth()->user()->company;


            $this->package = $this->company->package;
            
        } else {
            $this->company = auth()->user()->employee->company;
            $this->package = auth()->user()->employee->company->package;
        }
        
        $this->counter_employees  =  $this->package->N_Of_Emps - Employee::countEmployeesByCompany($this->company->id);

        if ($this->counter_employees  < 0) {
            # code...
            $this->counter_employees = 0;
        }

        $this->counter_admins  =  $this->package->N_Of_Adminstrative - Employee::countAdminsByCompany($this->company->id);

        $this->branches = Branche::where('company_id',$this->company->id)->get();





       // dd($this->counter_employees);
        
    }

    public function save()
    {
     
        if (($this->counter_admins > 0 && $this->is_adminstaror == 1) || ($this->counter_employees > 0 && $this->is_adminstaror == 0) ) {
            $this->validate();

            $user = $this->createUser($this->validate());
    
            $employee = $this->createEmp($this->validate(),$user);
    
            $store = $this->storeFiles($this->files,$user,$employee);
    
            $worktime = $this->worktime($employee);

            $role = $this->is_adminstaror == 0 ? 4 : 3;

            $user->addRole($role);
    
    
    
            $this->dialog()->success(
                $title = __('Add Employee'),
                $description = __('Employee added successfully')
            );
            
    
            $this->dispatch('refresh');
        }
        else
        {
            $this->dialog()->error(
                $title = __('Add Employee'),
                $description = __('Employee addition was unsuccessful')
            );

        }




    }
    
    public function render()
    {
        return view('livewire.backend.company.employee.create');
    }
}
