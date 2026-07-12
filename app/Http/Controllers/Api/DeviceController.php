<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

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

    /*
|--------------------------------------------------------------------------
| Active Devices List
|--------------------------------------------------------------------------
*/

public function list(Request $request)
{
    $devices = Device::with('gate')
        ->where('status', 1);

    if ($request->filled('type')) {
        $devices->where('type', $request->type);
    }

    return response()->json(
        $devices->orderBy('name')->get()
    );
}
}