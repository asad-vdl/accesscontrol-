<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;


class DeviceHeartbeatController extends Controller
{

    public function heartbeat(Request $request)
    {

        $request->validate([

            'device_code' => 'required'

        ]);



        // Find Device
        $device = Device::where(
            'device_code',
            $request->device_code
        )->first();



        // Device not found
        if(!$device)
        {

            return response()->json([

                'status'=>'error',

                'message'=>'Device Not Found'

            ],404);

        }



        // Update heartbeat time
        $device->update([

    'last_seen' => now(),

    'online_status' => 1

]);

        $device->refresh();



        return response()->json([

            'status'=>'online',

            'message'=>'Heartbeat Updated',

            'device'=>$device->name,

            'last_seen'=>$device->last_seen

        ]);

    }

}