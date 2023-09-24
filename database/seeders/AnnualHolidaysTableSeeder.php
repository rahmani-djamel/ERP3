<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class AnnualHolidaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Define the number of records you want to insert
        $numberOfRecords = 20; // You can change this number

        // Loop to insert fake data
        for ($i = 0; $i < $numberOfRecords; $i++) {
            DB::table('annual_holidays')->insert([
                'employee_id' => $faker->numberBetween(1, 12), // Replace with actual employee IDs
                'start_date' => $faker->date,
                'end_date' => $faker->date,
                'extend' => $faker->numberBetween(0, 5),
                'type' => $faker->randomElement(['Vacation', 'Sick Leave', 'Public Holiday']), // Customize as needed
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
