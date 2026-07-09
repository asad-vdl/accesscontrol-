<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Gate;
use App\Models\UserGatePermission;

class UserGatePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserGatePermission::query()->delete();

        $mainGate = Gate::where('gate_code', 'MAIN_GATE')->first();
        $gate2 = Gate::where('gate_code', 'GATE_2')->first();
        $office = Gate::where('gate_code', 'OFFICE_ENTRANCE')->first();

        // ==========================
        // System Administrator
        // All Gates
        // ==========================

        $admin = User::where('employee_id', 'EMP001')->first();

        UserGatePermission::create([
            'user_id' => $admin->id,
            'gate_id' => $mainGate->id,
            'access_allowed' => 1,
        ]);

        UserGatePermission::create([
            'user_id' => $admin->id,
            'gate_id' => $gate2->id,
            'access_allowed' => 1,
        ]);

        UserGatePermission::create([
            'user_id' => $admin->id,
            'gate_id' => $office->id,
            'access_allowed' => 1,
        ]);

        // ==========================
        // Ali
        // Main Gate Only
        // ==========================

        $ali = User::where('employee_id', 'EMP002')->first();

        UserGatePermission::create([
            'user_id' => $ali->id,
            'gate_id' => $mainGate->id,
            'access_allowed' => 1,
        ]);

        // ==========================
        // Asad
        // Gate 2 Only
        // ==========================

        $asad = User::where('employee_id', 'EMP003')->first();

        UserGatePermission::create([
            'user_id' => $asad->id,
            'gate_id' => $gate2->id,
            'access_allowed' => 1,
        ]);

        // ==========================
        // Ahmed (Inactive)
        // Office Only
        // ==========================

        $ahmed = User::where('employee_id', 'EMP004')->first();

        UserGatePermission::create([
            'user_id' => $ahmed->id,
            'gate_id' => $office->id,
            'access_allowed' => 1,
        ]);
    }
}