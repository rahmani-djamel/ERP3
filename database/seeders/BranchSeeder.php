<?php

namespace Database\Seeders;

use App\Models\Branche;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            Branche::create([
                'name' => $faker->company, // Generate a random company name
                'place' => $faker->address, // Generate a random address
                'map' => $faker->unique()->url, // Generate a unique random URL
                'lat' =>  30.9790555, // Generate a random latitude
                'long' => 31.449317, // Generate a random longitude

            ]);
        }
    }
}
