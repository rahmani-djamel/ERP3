<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owner = User::create([
            'name' => 'عبد الله الكناني',
            'email' => 'abmalkinani@gmail.com',
            'password' => bcrypt('password'), // You can set a default password here
        ]);

        $owner->addRole(1); // parameter can be a Role object, BackedEnum, array, id or the role string name
    }
}
