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
    $jsonFilePath = base_path('lang/ar.json');

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
    public function GetWord($key)
    {
        // The translation key to search for
        $translationKey = $key;
    
        // Path to the ar.json file in the root directory
        $jsonFilePath = base_path('lang/ar.json');
    
        // Load the existing JSON data
        $jsonData = File::get($jsonFilePath);
        $translations = json_decode($jsonData, true);
    
        // Check if the key exists
        if (array_key_exists($translationKey, $translations)) {
            // If the key exists, return the translation value
            return $translations[$translationKey];
        }
    
        // If the key doesn't exist, return null
        return null;
    }
    public function EditWord($key, $newKey,$value)
    {
        // The translation key to search for
        $translationKey = $key;
    
        // Path to the ar.json file in the root directory
        $jsonFilePath = base_path('lang/ar.json');
    
        // Load the existing JSON data
        $jsonData = File::get($jsonFilePath);
        $translations = json_decode($jsonData, true);
    
        // Check if the key exists
        if (array_key_exists($translationKey, $translations)) {
            // Get the translation value
            $translationValue = $translations[$translationKey];
    
            // Remove the old key
            unset($translations[$translationKey]);
    
            // Add the new key with the same translation value
     
            $translations[$newKey] = $value;

            // Encode the updated translations to JSON without escaping Unicode characters
            $updatedJson = json_encode($translations, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    
            // Write the updated JSON data back to the file
            File::put($jsonFilePath, $updatedJson);
    
            // Return true to indicate a successful edit
            return true;
        }
    
        // If the key doesn't exist, return false to indicate that no edit was performed
        return false;
    }
    
}
