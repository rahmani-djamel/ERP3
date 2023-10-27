<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Basic',
                'price' => 100.00,
                'days' => 30,
                'N_Of_Emps' => 50,
                'N_Of_Adminstrative' => 10,
                'N_branches' => 5,
            ],
            [
                'name' => 'Standard',
                'price' => 200.00,
                'days' => 60,
                'N_Of_Emps' => 100,
                'N_Of_Adminstrative' => 20,
                'N_branches' => 10,
            ],
            [
                'name' => 'Premium',
                'price' => 300.00,
                'days' => 90,
                'N_Of_Emps' => 200,
                'N_Of_Adminstrative' => 30,
                'N_branches' => 15,
            ],
        ];

        // Insert the data into the 'packages' table
        DB::table('packages')->insert($packages);
    }
}
