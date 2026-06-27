<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Device;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Device::updateOrCreate(

            [
                'device_code' => 'MAIN_GATE_001'
            ],

            [
                'name' => 'Main Gate Reader',

                'type' => 'RFID',

                'device_code' => 'MAIN_GATE_001',

                'ip_address' => null,

                'location' => 'Main Gate',

                'status' => 1,

                'api_token' => 'rOtWV3Kj6vwEk2IDM8Tu9YGWYMpW0ZqKxLvvnNJRvWw5QhJ08pnS6OWJqHR6',
            ]

        );
    }
}