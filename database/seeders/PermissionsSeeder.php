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

    }
}
