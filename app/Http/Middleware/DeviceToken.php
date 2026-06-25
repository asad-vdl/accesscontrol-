<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Device;

class DeviceToken
{

    public function handle(Request $request, Closure $next)
    {

        $token = $request->header('X-Device-Token');


        if (!$token) {

            return response()->json([
                'message' => 'Device token missing'
            ], 401);

        }


        $device = Device::where('api_token', $token)
                        ->where('status', 1)
                        ->first();


        if (!$device) {

            return response()->json([
                'message' => 'Invalid device token'
            ], 401);

        }


        // device ko request ke sath attach kar diya
        $request->device = $device;


        return $next($request);

    }

}