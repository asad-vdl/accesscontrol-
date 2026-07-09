<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AccessLog;
use App\Models\Credential;
use App\Models\UserGatePermission;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'credential_type'  => 'required',
            'credential_value' => 'required',
        ]);

        // Authenticated device from middleware
        $device = $request->device->load('gate');

        /*
        |--------------------------------------------------------------------------
        | Find Credential
        |--------------------------------------------------------------------------
        */

        $credential = Credential::where('credential_type', $request->credential_type)
            ->where('credential_value', $request->credential_value)
            ->where('status', 1)
            ->first();

        if (!$credential) {

            AccessLog::create([
                'user_id'           => null,
                'device_id'         => $device->id,
                'credential_type'   => $request->credential_type,
                'credential_value'  => $request->credential_value,
                'access_status'     => 'denied',
                'remarks'           => 'Invalid Credential',
            ]);

            return response()->json([
                'status'  => 'denied',
                'message' => 'Invalid Credential',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | User Check
        |--------------------------------------------------------------------------
        */

        $user = $credential->user;

        if (!$user || !$user->status) {

            AccessLog::create([
                'user_id'           => $credential->user_id,
                'device_id'         => $device->id,
                'credential_type'   => $request->credential_type,
                'credential_value'  => $request->credential_value,
                'access_status'     => 'denied',
                'remarks'           => 'User Inactive',
            ]);

            return response()->json([
                'status'  => 'denied',
                'message' => 'User Account Inactive',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Device Gate Check
        |--------------------------------------------------------------------------
        */

        if (!$device->gate) {

            AccessLog::create([
                'user_id'           => $user->id,
                'device_id'         => $device->id,
                'credential_type'   => $request->credential_type,
                'credential_value'  => $request->credential_value,
                'access_status'     => 'denied',
                'remarks'           => 'Device Not Assigned To Gate',
            ]);

            return response()->json([
                'status'  => 'denied',
                'message' => 'Device is not assigned to any gate',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Gate Permission Check
        |--------------------------------------------------------------------------
        */

        $permission = UserGatePermission::where('user_id', $user->id)
            ->where('gate_id', $device->gate_id)
            ->where('access_allowed', 1)
            ->exists();

        if (!$permission) {

            AccessLog::create([
                'user_id'           => $user->id,
                'device_id'         => $device->id,
                'credential_type'   => $request->credential_type,
                'credential_value'  => $request->credential_value,
                'access_status'     => 'denied',
                'remarks'           => 'Gate Permission Denied',
            ]);

            return response()->json([
                'status'  => 'denied',
                'message' => 'Access Not Allowed For This Gate',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Access Granted
        |--------------------------------------------------------------------------
        */

        AccessLog::create([
            'user_id'           => $user->id,
            'device_id'         => $device->id,
            'credential_type'   => $request->credential_type,
            'credential_value'  => $request->credential_value,
            'access_status'     => 'granted',
            'remarks'           => 'Gate Access Granted',
        ]);

        return response()->json([
            'status'    => 'granted',
            'message'   => 'Access Allowed',
            'user_id'   => $user->id,
            'user_name' => $user->name,
            'gate'      => $device->gate->name,
            'device'    => $device->name,
        ]);
    }
}