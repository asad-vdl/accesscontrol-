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




        if(!$token)
        {

            return response()->json([

                'message'=>'Device token missing'

            ],401);

        }







        if(!$request->device_code)
        {


            return response()->json([

                'message'=>'Device code missing'

            ],401);


        }








        $device = Device::where('api_token',$token)

                ->where('device_code',$request->device_code)

                ->where('status',1)

                ->first();








        if(!$device)
        {


            return response()->json([

                'message'=>'Invalid device authentication'

            ],401);


        }







        // Attach device

        $request->merge([

            'device'=>$device

        ]);








        return $next($request);



    }



}