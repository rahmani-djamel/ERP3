<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worktime extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'vacation_id',
        'work_start',
        'work_end',
        'is_vacation',
        'is_changed',
    ];

    public function vacation() {
        return $this->belongsTo(Vacation::class);
    }
}
