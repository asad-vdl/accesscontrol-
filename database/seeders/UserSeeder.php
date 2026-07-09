<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->delete();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@smartaccess.com',
            'phone' => '0501234567',
            'employee_id' => 'EMP001',
            'photo' => null,
            'role' => 'admin',
            'password' => Hash::make('admin123'),
            'status' => 1,
        ]);

        User::create([
            'name' => 'Ali Ahmed',
            'email' => 'ali@smartaccess.com',
            'phone' => '0501111111',
            'employee_id' => 'EMP002',
            'photo' => null,
            'role' => 'user',
            'password' => Hash::make('password'),
            'status' => 1,
        ]);

        User::create([
            'name' => 'Muhammad',
            'email' => 'Muhammad@smartaccess.com',
            'phone' => '0502222222',
            'employee_id' => 'EMP003',
            'photo' => null,
            'role' => 'user',
            'password' => Hash::make('password'),
            'status' => 1,
        ]);

        User::create([
            'name' => 'Ahmed Khan',
            'email' => 'ahmed@smartaccess.com',
            'phone' => '0503333333',
            'employee_id' => 'EMP004',
            'photo' => null,
            'role' => 'user',
            'password' => Hash::make('password'),
            'status' => 0,
        ]);
    }
}