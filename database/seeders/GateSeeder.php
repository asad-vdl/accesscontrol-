<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gate;

class GateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gate::query()->delete();

        Gate::create([
            'name'      => 'Main Gate',
            'gate_code' => 'MAIN_GATE',
            'location'  => 'Guard Room',
            'status'    => 1,
        ]);

        Gate::create([
            'name'      => 'Gate 2',
            'gate_code' => 'GATE_2',
            'location'  => 'Warehouse',
            'status'    => 1,
        ]);

        Gate::create([
            'name'      => 'Office Entrance',
            'gate_code' => 'OFFICE_ENTRANCE',
            'location'  => 'Administration Block',
            'status'    => 1,
        ]);
    }
}