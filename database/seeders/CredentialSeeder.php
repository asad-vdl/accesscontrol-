<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Credential;
use App\Models\User;

class CredentialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@smartaccess.com')->first();

        if (!$admin) {
            return;
        }

        Credential::updateOrCreate(

            [
                'credential_value' => '12345678'
            ],

            [
                'user_id' => $admin->id,

                'credential_type' => 'card',

                'credential_value' => '12345678',

                'status' => 1,
            ]

        );
    }
}