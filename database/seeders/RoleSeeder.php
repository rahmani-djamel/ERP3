<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owner = Role::create([
            'name' => 'owner',
            'display_name' => 'Project Owner', // optional
            'description' => 'User is the owner of a given project', // optional
        ]);
        
        $manger = Role::create([
            'name' => 'manger',
            'display_name' => 'User Manger', // optional
            'description' => 'User is allowed to manage and edit other users', // optional
        ]);

        $Administrative = Role::create([
            'name' => 'administrative',
            'display_name' => 'User Administrative', // optional
            'description' => 'User is the administrative of a given project', // optional
        ]);
        
        $employee = Role::create([
            'name' => 'employee',
            'display_name' => 'User Employee', // optional
            'description' => 'User is  employee', // optional
        ]);
    }
}
