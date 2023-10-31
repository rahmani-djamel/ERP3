<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BranchSeeder::class,
            EmployeeSeeder::class,
            VacationsSeeder::class,
            WorktimeSeeder::class,
           // AttendanceTableSeeder::class,
            SettingsSeeder::class,
            VacationTypesSeeder::class,
            PermissionsSeeder::class,
            LanguageSeeder::class,
            RoleSeeder::class,
            OwnerSeeder::class,
            PackagesTableSeeder::class,
            CompanySeeder::class
        ]);

    }
}
