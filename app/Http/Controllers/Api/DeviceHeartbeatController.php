<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class DeviceHeartbeatController extends Controller
{


    public function heartbeat(Request $request)
    {



        $device = $request->device;



        if(!$device)
        {

            return response()->json([

                'status'=>'error',

                'message'=>'Device Authentication Failed'

            ],401);


        }







        $device->update([


            'last_seen'=>now(),


            'online_status'=>1


        ]);






        $device->refresh();







        return response()->json([


            'status'=>'online',


            'message'=>'Heartbeat Updated',


            'device'=>$device->name,


            'device_code'=>$device->device_code,


            'gate'=>$device->gate ? $device->gate->name : null,


            'last_seen'=>$device->last_seen



        ]);




    }



}