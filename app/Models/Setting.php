<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'DaysMonth',
        'MinVacationDays',
        'Nationality',
        'VacationDay',
        'ValidityOfAnnualLeave',
        'Guarantee',
        'WillPay',
        'MaximumVacationEmployees',
        'PathCreated',
        'AutomaticDeduction',
        'PeriodBetweenTwoVacations',
        'SubmittingLeave',
        'AutomaticApproval',
    ];
}
