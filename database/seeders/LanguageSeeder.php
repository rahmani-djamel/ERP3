<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Insert records for Arabic language
                DB::table('languages')->insert([
                    'language_code' => 'ar',
                    'country_code' => 'SA',
                    'name' => 'العربية',
                    'is_active' => true,
                    'force_rtl' => true,
                ]);
        
                // Insert records for English language
                DB::table('languages')->insert([
                    'language_code' => 'en',
                    'country_code' => 'US',
                    'name' => 'English',
                    'is_active' => true,
                    'force_rtl' => false,
                ]);
    }
}
