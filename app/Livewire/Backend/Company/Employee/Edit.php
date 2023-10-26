<?php

namespace App\Livewire\Backend\Company\Employee;

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
        ];
    }


    public function mount()
    {

        $properties = $this->mapping();
    
        foreach ($properties as $property) {
            $this->{$property} = $this->employee->{$property};
        }
    }

    public function save()
    {
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
    public function render()
    {
        return view('livewire.backend.company.employee.edit');
    }
}
