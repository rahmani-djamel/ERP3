<?php

use App\Models\Branche;
use App\Models\Vacationtype;
use Illuminate\Support\Facades\Cache;

function settings($settings, $updateCache = false)
{

    switch ($settings) {

    // Branches settings
    case 'branches':

        // Check if want to update cache
        if ($updateCache) {

            // Remove it from cache
            Cache::forget('branches');

        } else {
    
            // Return data
            return Cache::rememberForever('branches', function () {
                return Branche::all();
            });

        }

        break;

        case 'VacationTypes':

            // Check if want to update cache
            if ($updateCache) {
    
                // Remove it from cache
                Cache::forget('VacationTypes');
    
            } else {
        
                // Return data
                return Cache::rememberForever('VacationTypes', function () {
                    return Vacationtype::all();
                });
    
            }
    
            break;
    }
}