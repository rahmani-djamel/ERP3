<?php

use App\Models\Branche;
use Illuminate\Support\Facades\Cache;

function settings($settings, $updateCache = false)
{

    switch ($settings) {

    // Appearance settings
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
    }
}