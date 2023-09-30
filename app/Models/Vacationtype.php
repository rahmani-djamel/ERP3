<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacationtype extends Model
{
    use HasFactory;

    public function  holidays()
    {
        return $this->hasMany(AnnualHoliday::class,'vacationtype_id');
    }
}
