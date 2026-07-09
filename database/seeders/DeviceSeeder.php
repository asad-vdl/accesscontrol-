<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\Gate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Device::query()->delete();

        // Main Gate
        $mainGate = Gate::where('gate_code', 'MAIN_GATE')->first();

        Device::create([
            'gate_id'       => $mainGate->id,
            'name'          => 'Main Gate RFID Reader',
            'type'          => 'RFID Reader',
            'device_code'   => 'MAIN_GATE_001',
            'ip_address'    => '192.168.1.10',
            'location'      => 'Guard Room',
            'status'        => 1,
            'api_token'     => Str::random(60),
            'last_seen'     => now(),
            'online_status' => 1,
        ]);

        Device::create([
            'gate_id'       => $mainGate->id,
            'name'          => 'Main Gate Keypad',
            'type'          => 'Keypad',
            'device_code'   => 'MAIN_GATE_PIN_001',
            'ip_address'    => '192.168.1.11',
            'location'      => 'Guard Room',
            'status'        => 1,
            'api_token'     => Str::random(60),
            'last_seen'     => now(),
            'online_status' => 1,
        ]);

        // Gate 2
        $gate2 = Gate::where('gate_code', 'GATE_2')->first();

        Device::create([
            'gate_id'       => $gate2->id,
            'name'          => 'Gate 2 RFID Reader',
            'type'          => 'RFID Reader',
            'device_code'   => 'GATE2_RFID_001',
            'ip_address'    => '192.168.1.20',
            'location'      => 'Warehouse',
            'status'        => 1,
            'api_token'     => Str::random(60),
            'last_seen'     => now(),
            'online_status' => 1,
        ]);

        Device::create([
            'gate_id'       => $gate2->id,
            'name'          => 'Gate 2 Keypad',
            'type'          => 'Keypad',
            'device_code'   => 'GATE2_PIN_001',
            'ip_address'    => '192.168.1.21',
            'location'      => 'Warehouse',
            'status'        => 1,
            'api_token'     => Str::random(60),
            'last_seen'     => now(),
            'online_status' => 1,
        ]);

        // Office Entrance
        $office = Gate::where('gate_code', 'OFFICE_ENTRANCE')->first();

        Device::create([
            'gate_id'       => $office->id,
            'name'          => 'Office Fingerprint',
            'type'          => 'Fingerprint',
            'device_code'   => 'OFFICE_FP_001',
            'ip_address'    => '192.168.1.30',
            'location'      => 'Administration Block',
            'status'        => 1,
            'api_token'     => Str::random(60),
            'last_seen'     => now(),
            'online_status' => 1,
        ]);

        Device::create([
            'gate_id'       => $office->id,
            'name'          => 'Office Face Recognition',
            'type'          => 'Face Recognition',
            'device_code'   => 'OFFICE_FACE_001',
            'ip_address'    => '192.168.1.31',
            'location'      => 'Administration Block',
            'status'        => 1,
            'api_token'     => Str::random(60),
            'last_seen'     => now(),
            'online_status' => 1,
        ]);
    }
}