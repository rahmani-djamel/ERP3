<?php

use App\Models\Branche;
use App\Models\Language;
use App\Models\Package;
use App\Models\Permission;
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

        case 'Permissions':

            // Check if want to update cache
            if ($updateCache) {
        
                // Remove it from cache
                Cache::forget('Permissions');
        
            } else {
            
                // Return data
                return Cache::rememberForever('Permissions', function () {
                    return Permission::all();
                });
        
            }
        
        break;

        case 'Languages':

            // Check if want to update cache
            if ($updateCache) {
        
                // Remove it from cache
                Cache::forget('Languages');
        
            } else {
            
                // Return data
                return Cache::rememberForever('Languages', function () {
                    return Language::all();
                });
        
            }
        
        break;

        
        case 'packages':

            // Check if want to update cache
            if ($updateCache) {
        
                // Remove it from cache
                Cache::forget('packages');
        
            } else {
            
                // Return data
                return Cache::rememberForever('packages', function () {
                    return Package::all();
                });
        
            }
        
        break;


    }
}