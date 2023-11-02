<?php

namespace App\Models;

use Carbon\Carbon;
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
        'branch_id',
        'is_adminstaror',
        'company_id'
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

    public static function countEmployeesByCompany($companyId)
    {
        return self::where('company_id', $companyId)->count();
    }

    public static function countAdminsByCompany($companyId)
    {
        return self::where('company_id', $companyId)->where('is_adminstaror',1)->count();
    }

    public function user()
    {
        return  $this->belongsTo(User::class);
    }

    public function company()
    {
        return  $this->belongsTo(Company::class);
    }

    public function worktime()
    {
       return $this->hasMany(Worktime::class);
    }
    public function annualholiday()
    {
        return $this->hasMany(AnnualHoliday::class);
    }
    public function branche()
    {
        return $this->belongsTo(Branche::class,'branch_id');
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function askpermessions()
    {
        return $this->hasMany(AskPermission::class);
    }

    public function resumework()
    {
        return $this->hasMany(ResumeWork::class);
    }

    public function roleCheck()
    {
        return $this->is_adminstaror == 1;
    }

    public function diffrence()
    {

        $totalDateDifference = 0;

        foreach ($this->annualholiday as $holiday) {
            $startDate = Carbon::parse($holiday->start_date);
            $endDate = Carbon::parse($holiday->end_date);
            $dateDifference = $startDate->diffInDays($endDate);

            $totalDateDifference += $dateDifference + $holiday->extend_days;
        }

        // Add the total date difference to the employee model

        return $totalDateDifference;

    }

    public function checkIfWorkToday()
    {
        // Get today's date
        $today = Carbon::today();
    
        // Iterate through the annual holidays of this employee
        foreach ($this->annualholiday as $holiday) {
            $startDate = Carbon::parse($holiday->start_date);
            $endDate = Carbon::parse($holiday->end_date);
    
            // Check if today falls within the holiday period
            if ($today->between($startDate, $endDate) || $today->equalTo($startDate)) {
                return 1;
            }
        }
    
        // If no holiday matches today's date, the employee is assumed to be working
        return 0;
    }
    public function CounterMounth($startDate,$endDate,$status)
    {
        $attendancesCount = $this->attendances()
        ->whereBetween('attendance_date', [$startDate, $endDate])
        ->where('status',$status)
        ->count();

        return $attendancesCount;

    }


}
