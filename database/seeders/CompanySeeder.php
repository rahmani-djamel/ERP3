<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Create 5 companies, each with a different owner
        for ($i = 1; $i <= 5; $i++) {
            // Create a user for the owner
            $user = User::create([
                'name' => 'Owner ' . $i,
                'email' => 'owner' . $i . '@example.com',
                'password' => Hash::make('password'),
            ]);

            // Create a company and associate it with the user as the owner
            Company::create([
                'name' => 'Company ' . $i,
                'user_id' => $user->id,
                'package_id' => 1, // Replace with your logic for package_id
                'days' => 30,      // Replace with your logic for days
                'Testing_period' => 0, // Default value
            ]);

            $user->addRole(2);
        }
    }
}
