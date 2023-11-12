<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branche extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'place',
        'map',
        'lat',
        'long',
        'company_id'
    ];

    public static function counter($companyId)
    {
        return self::where('company_id', $companyId)->count();
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
