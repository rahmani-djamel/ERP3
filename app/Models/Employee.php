<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'Name',
        'email',
        'CarteNumber',
        'JobNumber',
        'Nationality',
        'Gender',
        'DateOfBirth',
        'Start_work',
        'End',
        'Phone',
        'VacationDays',
        'ContratType',
        'Rating',
        'Status',
        'FriendName',
        'FriendPhone',
        'InsuranceClass',
        'InsuranceExpiryDate',
        'BankName',
        'BankNumber',
        'BasicSalary',
        'OtherAllowances',
        'InsuranceRatio',
        'InsuranceSubscriptionAmount',
        'HousingAllowance',
        'transportationAllowance',
        'VacationSalary',
        'DurationOfTheWarningPeriod',
        'LoanHistory',
        'CovenantRecord',
        'user_id'
    ];
}
