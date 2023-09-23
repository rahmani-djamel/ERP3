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
        'user_id',
        'branch_id'
    ];


    public function scopeSearch($query, $value){
        $query->where('Name','like',"%{$value}%")
        ->orWhere('email','like',"%{$value}%")
        ->orWhere('JobNumber','like',"%{$value}%");
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function user()
    {
        return  $this->belongsTo(User::class);
    }

    public function worktime()
    {
       return $this->hasMany(Worktime::class);
    }
}
