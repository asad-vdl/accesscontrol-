<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAccessSchedule;
use Illuminate\Database\Seeder;

class UserAccessScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {

            UserAccessSchedule::firstOrCreate(

                [
                    'user_id' => $user->id,
                ],

                [
                    'monday' => true,
                    'tuesday' => true,
                    'wednesday' => true,
                    'thursday' => true,
                    'friday' => true,
                    'saturday' => false,
                    'sunday' => false,

                    'start_time' => '08:00:00',
                    'end_time' => '18:00:00',

                    'valid_from' => null,
                    'valid_to' => null,

                    'status' => true,
                ]

            );

        }
    }
}