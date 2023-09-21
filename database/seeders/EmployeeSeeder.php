<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create 50 employees
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            // Create a new user for each employee
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'), // You can set a default password here
            ]);

            // Create an employee record and associate it with the user
            Employee::create([
                'Name' => $faker->name,
                'email' => $user->email, // Use the same email as the associated user
                'CarteNumber' => $faker->unique()->ean13,
                'JobNumber' => $faker->unique()->ean8,
                'Nationality' => $faker->country,
                'Gender' => $faker->randomElement(['Male', 'Female']),
                'DateOfBirth' => $faker->date,
                'Start_work' => $faker->date,
                'End' => $faker->date,
                'Phone' => $faker->phoneNumber,
                'VacationDays' => $faker->numberBetween(10, 30),
                'ContratType' => $faker->word,
                'Rating' => $faker->word,
                'Status' => $faker->word,
                'FriendName' => $faker->name,
                'FriendPhone' => $faker->phoneNumber,
                'InsuranceClass' => $faker->word,
                'InsuranceExpiryDate' => $faker->date,
                'BankName' => $faker->word,
                'BankNumber' => $faker->unique()->bankAccountNumber,
                'BasicSalary' => $faker->randomFloat(2, 2000, 5000),
                'OtherAllowances' => $faker->randomFloat(2, 0, 1000),
                'InsuranceRatio' => $faker->randomFloat(2, 0, 1),
                'InsuranceSubscriptionAmount' => $faker->randomFloat(2, 100, 500),
                'HousingAllowance' => $faker->randomFloat(2, 500, 2000),
                'transportationAllowance' => $faker->randomFloat(2, 100, 500),
                'VacationSalary' => $faker->randomFloat(2, 1000, 3000),
                'DurationOfTheWarningPeriod' => $faker->word,
                'LoanHistory' => $faker->text,
                'CovenantRecord' => $faker->text,
                'user_id' => $user->id,
                'branch_id' => 1
            ]);
        }
    }
}