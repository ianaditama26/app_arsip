<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = User::create([
            'name' => 'Adminitator',
            'email' => 'admin@gmail.test',
            'password' => bcrypt(12345),
            'role' => 'admin'
        ]);

        $roleAdmin->assignRole('admin');

        $roleEmployee = User::create([
            'name' => 'User',
            'email' => 'employee@gmail.test',
            'password' => bcrypt(12345),
            'role' => 'employee'
        ]);

        $roleEmployee->assignRole('employee');

        $roleEmployeeIan = User::create([
            'name' => 'Septian aditama',
            'email' => 'ian@gmail.test',
            'password' => bcrypt(12345),
            'role' => 'employee'
        ]);

        $roleEmployeeIan->assignRole('employee');
    }
}
