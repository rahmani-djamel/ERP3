<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AskPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'date',
        'start_time',
        'duration',
        'justification',
        'status',
        'answer',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
