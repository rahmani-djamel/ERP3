<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'user_id', 'package_id', 'days', 'Testing_period'];


    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
