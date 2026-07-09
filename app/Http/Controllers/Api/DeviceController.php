<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;

class DeviceController extends Controller
{

    public function token($device_code)
    {

        $device = Device::where('device_code', $device_code)
            ->where('status', 1)
            ->first();

        if (!$device) {

            return response()->json([
                'status' => 'error',
                'message' => 'Device not found'
            ], 404);

        }

        return response()->json([

            'device_code' => $device->device_code,

            'api_token' => $device->api_token,

        ]);

    }

}