<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Device;
use Carbon\Carbon;

class CheckDeviceStatus extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'devices:check-status';

    /**
     * The console command description.
     */
    protected $description = 'Check devices and mark them online or offline';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $devices = Device::all();

        foreach ($devices as $device) {

            if (!$device->last_seen) {

                $device->update([
                    'online_status' => 0
                ]);

                continue;
            }

            $minutes = Carbon::parse($device->last_seen)
                ->diffInMinutes(now());

            if ($minutes >= 2) {

                $device->update([
                    'online_status' => 0
                ]);

            } else {

                $device->update([
                    'online_status' => 1
                ]);

            }
        }

        $this->info('Device status check completed.');

        return Command::SUCCESS;
    }
}