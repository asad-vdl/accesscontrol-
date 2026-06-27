<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(

            [
                'email' => 'admin@smartaccess.com'
            ],

            [
                'name' => 'System Administrator',

                'email' => 'admin@smartaccess.com',

                'phone' => null,

                'employee_id' => 'ADMIN001',

                'password' => Hash::make('admin123'),

                'role' => 'admin',

                'status' => 1,

                'photo' => null,
            ]

        );
    }
}