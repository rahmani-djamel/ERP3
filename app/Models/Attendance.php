<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'attendance_date',
        'day_of_week',
        'employee_id',
        'leave'
    ];


    public function employee()
    {
        return  $this->belongsTo(Employee::class);
    }
}
