<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                //employee

                $CreateEmployee = Permission::create([
                    'name' => 'create-employee',
                    'display_name' => 'Create employee', // optional
                    'description' => 'employees', // optional
                    'class' => 'employee'
                ]);
                $Reademployee = Permission::create([
                        'name' => 'read-employee',
                        'display_name' => 'Read employee Information', // optional
                        'description' => 'Read employee Information', // optional
                        'class' => 'employee'

                ]);
                $Deleteemployee = Permission::create([
                    'name' => 'delete-employee',
                    'display_name' => 'Delete employee', // optional
                    'description' => 'Delete employee', // optional
                    'class' => 'employee'

                ]);
        
                $Editemployee = Permission::create([
                    'name' => 'edit-employee',
                    'display_name' => 'Edit employee Information', // optional
                    'description' => 'Edit employee Information', // optional
                    'class' => 'employee'

                ]);

                //attendance

                $Createattendance = Permission::create([
                    'name' => 'read-report-attendance',
                    'display_name' => 'Read report', // optional
                    'description' => 'report', // optional
                    'class' => 'attendance'
                ]);
                
                $Readattendance = Permission::create([
                        'name' => 'read-statment-attendance',
                        'display_name' => 'Read Satatment Information', // optional
                        'description' => 'Read Stamtent Information', // optional
                        'class' => 'attendance'
                ]);

                //Vacations

                $AnnulaLeaves = Permission::create([
                    'name' => 'annual-leave',
                    'display_name' => 'Annual leaves', // optional
                    'description' => 'Annual leaves', // optional
                    'class' => 'Vacations'
                ]);
                
                $WeekEndDays = Permission::create([
                    'name' => 'weekend-days',
                    'display_name' => 'Weekend days', // optional
                    'description' => 'WeekEnd Days', // optional
                    'class' => 'Vacations'
                ]);

                $employeesWorkingHours = Permission::create([
                    'name' => 'employees-working-hours',
                    'display_name' => 'Employees working hours', // optional
                    'description' => 'Annual leave', // optional
                    'class' => 'Vacations'
                ]);

                //Salaries and commissions

                $SalariesAndCommissions = Permission::create([
                    'name' => 'salaries-and-commissions',
                    'display_name' => 'Salaries and commissions', // optional
                    'description' => 'Salaries And Commissions', // optional
                    'class' => 'Salaries and commissions'
                ]);

                //Appeal requests

                $AppealRequests = Permission::create([
                    'name' => 'appeal-requests',
                    'display_name' => 'Appeal requests', // optional
                    'description' => 'Appeal requests', // optional
                    'class' => 'Appeal requests'
                ]);

                //ask permission


                $AskPermission = Permission::create([
                    'name' => 'ask-permission',
                    'display_name' => 'ask permission', // optional
                    'description' => 'ask permission', // optional
                    'class' => 'ask permission'
                ]);

              //settings


              $settings = Permission::create([
                'name' => 'company-settings',
                'display_name' => 'Settings', // optional
                'description' => 'ask permission', // optional
                'class' => 'Settings'
            ]);




    }
}
