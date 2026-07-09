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
        Credential::query()->delete();

        // ==========================
        // System Administrator
        // ==========================
        $admin = User::where('employee_id', 'EMP001')->first();

        Credential::create([
            'user_id' => $admin->id,
            'credential_type' => 'card',
            'credential_value' => '1234567890',
            'status' => 1,
            'notes' => 'Admin RFID Card',
        ]);

        Credential::create([
            'user_id' => $admin->id,
            'credential_type' => 'pin',
            'credential_value' => '1234',
            'status' => 1,
            'notes' => 'Admin PIN',
        ]);

        Credential::create([
            'user_id' => $admin->id,
            'credential_type' => 'fingerprint',
            'credential_value' => 'FP001',
            'status' => 1,
            'notes' => 'Admin Fingerprint',
        ]);

        // ==========================
        // Ali Ahmed
        // ==========================
        $ali = User::where('employee_id', 'EMP002')->first();

        Credential::create([
            'user_id' => $ali->id,
            'credential_type' => 'card',
            'credential_value' => '2234567890',
            'status' => 1,
            'notes' => 'Ali RFID Card',
        ]);

        Credential::create([
            'user_id' => $ali->id,
            'credential_type' => 'pin',
            'credential_value' => '2222',
            'status' => 1,
            'notes' => 'Ali PIN',
        ]);

        // ==========================
        // Muhammad Asad
        // ==========================
        $asad = User::where('employee_id', 'EMP003')->first();

        Credential::create([
            'user_id' => $asad->id,
            'credential_type' => 'card',
            'credential_value' => '3234567890',
            'status' => 1,
            'notes' => 'Asad RFID Card',
        ]);

        Credential::create([
            'user_id' => $asad->id,
            'credential_type' => 'pin',
            'credential_value' => '3333',
            'status' => 1,
            'notes' => 'Asad PIN',
        ]);

        // ==========================
        // Ahmed Khan (Inactive User)
        // ==========================
        $ahmed = User::where('employee_id', 'EMP004')->first();

        Credential::create([
            'user_id' => $ahmed->id,
            'credential_type' => 'card',
            'credential_value' => '4234567890',
            'status' => 1,
            'notes' => 'Inactive User Card',
        ]);
    }
}