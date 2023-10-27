<?php

namespace App\Traits\Lang;

use Illuminate\Support\Facades\File;

trait LangTrait 
{
    public function addToFile($key,$value)
    {
    // The translation key and value to add
    $newTranslationKey = $key;
    $newTranslationValue = $value;

    // Path to the ar.json file in the root directory
    $jsonFilePath = base_path('ar.json');

    // Load the existing JSON data
    $jsonData = File::get($jsonFilePath);
    $translations = json_decode($jsonData, true);

    // Check if the key already exists
    if (array_key_exists($newTranslationKey, $translations)) {
        // If the key exists, add a space and make a new key
        $newTranslationKey .= ' ';
    }

    // Add the new translation key and value
    $translations[$newTranslationKey] = $newTranslationValue;

    // Encode the updated data back to JSON
    $updatedJsonData = json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Write the updated JSON data back to the file
    File::put($jsonFilePath, $updatedJsonData);


    }
}
