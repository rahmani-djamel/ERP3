<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnualHoliday extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'start_date',
        'end_date',
        'type',
        'vacationtype_id'
    ];

    public function scopeSearch($query, $value){
        $query->whereHas('employee', function ($employeeQuery) use ($value) {
            $employeeQuery->where('Name', 'like', "%{$value}%")
            ->orWhere('JobNumber','like',"%{$value}%");
        });

    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function  vacationtype()
    {
        return $this->belongsTo(Vacationtype::class,'vacationtype_id');
    }

}
