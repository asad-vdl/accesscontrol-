<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Device;
use App\Models\UserDevicePermission;

class UserDevicePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin@smartaccess.com')->first();

        $device = Device::where('name', 'Main Gate Reader')->first();

        if (!$user || !$device) {
            return;
        }

        UserDevicePermission::updateOrCreate(

            [
                'user_id' => $user->id,
                'device_id' => $device->id,
            ],

            [
                'access_allowed' => 1,
            ]

        );
    }
}