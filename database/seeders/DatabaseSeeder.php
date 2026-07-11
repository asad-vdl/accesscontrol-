<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
        GateSeeder::class,
        DeviceSeeder::class,
        UserSeeder::class,
        CredentialSeeder::class,
        UserGatePermissionSeeder::class,
        UserAccessScheduleSeeder::class,

        ]);
    }
}