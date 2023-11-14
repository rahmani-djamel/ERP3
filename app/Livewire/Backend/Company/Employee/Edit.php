<?php

namespace App\Livewire\Backend\Company\Employee;

use App\Models\Branche;
use App\Models\Employee;
use App\Traits\Employee\EmpTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use WireUi\Traits\Actions;

class Edit extends Component
{
    use EmpTrait,Actions;

    public Employee $employee;

    
    public $Name = '';
    public $email = '';
    public $CarteNumber = '';
    public $JobNumber = '';
    public $Nationality = '';
    public $Gender = '';
    public $DateOfBirth = '';
    public $Start_work;
    public $End;
    public $Phone = '';
    public $VacationDays = '';
    public $ContratType = '';
    public $Rating = '';
    public $Status = '';
    public $FriendName = '';
    public $FriendPhone = '';
    public $InsuranceClass = '';
    public $InsuranceExpiryDate = '';
    public $BankName = '';
    public $BankNumber = '';
    public $BasicSalary = '';
    public $OtherAllowances = '';
    public $InsuranceRatio = '';
    public $InsuranceSubscriptionAmount = '';
    public $HousingAllowance = '';
    public $transportationAllowance = '';
    public $VacationSalary = '';
    public $DurationOfTheWarningPeriod = '';
    public $LoanHistory = '';
    public $CovenantRecord = '';
    public $branch_id;
    public $is_adminstaror;

    
    public $user;
    public $company;
    public $package;
    public $counter_employees = 0;
    public $counter_admins = 0;
    public $role_name;
    public $branch_name;
    public $branches;


    public function rules()
    {
        return [
            'Name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,'.$this->employee->id,
            'CarteNumber' => 'required|string|max:255',
            'JobNumber' => 'required|string|max:255',
            'Nationality' => 'required|string|max:255',
            'Gender' => 'required|string|max:255',
            'DateOfBirth' => 'required|date',
            'Start_work' => 'required|date',
            'End' => 'required|date',
            'Phone' => 'required|string|max:20',
            'VacationDays' => 'required|integer',
            'ContratType' => 'required|string|max:255',
            'Rating' => 'required|string|max:255',
            'Status' => 'required|string|max:255',
            'FriendName' => 'nullable|string|max:255',
            'FriendPhone' => 'nullable|string|max:20',
            'InsuranceClass' => 'nullable|string|max:255',
            'InsuranceExpiryDate' => 'nullable|date',
            'BankName' => 'nullable|string|max:255',
            'BankNumber' => 'nullable|string|max:255',
            'BasicSalary' => 'required|string|max:255',
            'OtherAllowances' => 'required|string|max:255',
            'InsuranceRatio' => 'required|string|max:255',
            'InsuranceSubscriptionAmount' => 'required|string|max:255',
            'HousingAllowance' => 'required|string|max:255',
            'transportationAllowance' => 'required|string|max:255',
            'VacationSalary' => 'required|string|max:255',
            'DurationOfTheWarningPeriod' => 'required|string|max:255',
            'LoanHistory' => 'nullable|string|max:255',
            'CovenantRecord' => 'nullable|string|max:255',
            'branch_id' => 'required',
            'is_adminstaror' => 'required|in:0,1'
        ];
    }


    public function mount()
    {

        $properties = $this->mapping();
    
        foreach ($properties as $property) {
            $this->{$property} = $this->employee->{$property};
        }



        if (auth()->user()->hasRole('manger')) {
            $this->company = auth()->user()->company;


            $this->package = $this->company->package;
            
        } else {
            $this->company = auth()->user()->employee->company;

            $this->package = auth()->user()->employee->company->package;
        }
        
        $this->counter_employees  =  $this->company->N_Of_Emps - Employee::countEmployeesByCompany($this->company->id);

        if ($this->counter_employees  < 0) {
            # code...
            $this->counter_employees = 0;
        }

        $this->counter_admins  =  $this->company->N_Of_Adminstrative - Employee::countAdminsByCompany($this->company->id);

        $this->role_name = $this->employee->is_adminstaror == 0 ? 'Employee' : 'Administrative';

        $this->branches = Branche::where('company_id',$this->company->id)->get();

    }

    public function save()
    {
        if ($this->employee->is_adminstaror == 1) 
        {
            $this->counter_admins++;
            
        } else {
            $this->counter_employees++;
        }
        
    if (($this->counter_admins > 0 && $this->is_adminstaror == 1) || ($this->counter_employees > 0 && $this->is_adminstaror == 0) ) {

        $validation = $this->validate();

        $properties = $this->mapping();
    
        foreach ($properties as $property) 
        {
            $this->employee->{$property} = $this->{$property};
        }

        $this->employee->save();

        $this->dialog()->success(
            $title = __('Edit Employee'),
            $description = __('Employee edited successfully')
        );
        

        $this->dispatch('refresh');
    }
    else
    {
        $this->dialog()->error(
            $title = __('Add Employee'),
            $description = __('Employee addition was unsuccessful')
        );

        if ($this->employee->is_adminstaror == 1) 
        {
            $this->counter_admins--;
            
        } else {
            $this->counter_employees--;
        }

    }

    }
    public function render()
    {
        return view('livewire.backend.company.employee.edit');
    }
}
