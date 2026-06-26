<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Credential;
use App\Models\AccessLog;
use App\Models\User;
use App\Models\UserDevicePermission;
use Illuminate\Http\Request;


class AccessController extends Controller
{

    public function check(Request $request)
    {

        $request->validate([

            'credential_type' => 'required',
            'credential_value' => 'required',

        ]);


        $device = $request->device;



        // Find Credential
        $credential = Credential::where(

                'credential_type',

                $request->credential_type

            )
            ->where(

                'credential_value',

                $request->credential_value

            )
            ->where(

                'status',

                1

            )
            ->first();




        // Credential not found
        if(!$credential)
        {

            AccessLog::create([

                'user_id'=>null,

                'device_id'=>$device->id,

                'credential_type'=>$request->credential_type,

                'credential_value'=>$request->credential_value,

                'access_status'=>'denied',

                'remarks'=>'Invalid Credential'

            ]);



            return response()->json([

                'status'=>'denied',

                'message'=>'Access Denied'

            ]);

        }




        // Find User
        $user = User::find($credential->user_id);



        // User inactive check
        if(!$user || $user->status == 0)
        {

            AccessLog::create([

                'user_id'=>$credential->user_id,

                'device_id'=>$device->id,

                'credential_type'=>$request->credential_type,

                'credential_value'=>$request->credential_value,

                'access_status'=>'denied',

                'remarks'=>'User Inactive'

            ]);



            return response()->json([

                'status'=>'denied',

                'message'=>'User Account Inactive'

            ]);

        }



        // Device Permission Check

$permission = UserDevicePermission::where('user_id', $credential->user_id)
    ->where('device_id', $device->id)
    ->where('access_allowed', 1)
    ->first();



        if(!$permission)
        {

            AccessLog::create([

                'user_id'=>$credential->user_id,

                'device_id'=>$device->id,

                'credential_type'=>$request->credential_type,

                'credential_value'=>$request->credential_value,

                'access_status'=>'denied',

                'remarks'=>'Device Permission Denied'

            ]);



            return response()->json([

                'status'=>'denied',

                'message'=>'Access Not Allowed For This Device'

            ]);

        }


        // Access Granted

        AccessLog::create([

            'user_id'=>$credential->user_id,

            'device_id'=>$device->id,

            'credential_type'=>$request->credential_type,

            'credential_value'=>$request->credential_value,

            'access_status'=>'granted',

            'remarks'=>'API Access Granted'

        ]);




        return response()->json([

    'status' => 'granted',

    'message' => 'Access Allowed',

    'user_id' => $credential->user_id,

    'user_name' => $user->name,

    'device' => $device->name

]);



    }

}