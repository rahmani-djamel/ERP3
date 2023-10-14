<?php

namespace App\Traits\DashboardEmployee;

use Carbon\Carbon;

trait EmpInformationTrait
{

    public function header()
    {
        return $columnMapping = [
            'Name' => 'Name',
            'JobNumber' => 'Job Number',
            'Gender' => 'Gender',
            'Nationality' => 'Nationality',
            'DateOfBirth' => 'Date of Birth',
            'Start_work' => 'Start Date',
            'ContratType' => 'Contract Type',
            'CarteNumber' => 'Card Number',
            'VacationSalary' => 'Vacation Salary',
            'VacationDays' => 'Vacation Balance',
            'Status' => 'Employee Status',
            'Rating' => 'Rating',
            'BasicSalary' => 'Basic Salary',
            'HousingAllowance' => 'Housing Allowance',
            'transportationAllowance' => 'Transportation Allowance',
            'Name1' => 'Name (1)',
            'Name2' => 'Name (2)',
            'InsuranceRatio' => 'Insurance Ratio',
            'InsuranceSubscriptionAmount' => 'Insurance Subscription Amount',
            'Phone' => 'Phone',
            'email' => 'Email',
            'FriendName' => 'Emergency Contact',
            'CovenantRecord' => 'Covenant Record',
            'InsuranceClass' => 'Insurance Class',
            'End' => 'End Date',
            'Name3' => 'Name (3)',
        ];
        
        
    }

}