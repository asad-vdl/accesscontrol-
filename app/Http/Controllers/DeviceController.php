<?php

namespace App\Http\Controllers;


use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



class DeviceController extends Controller
{


    public function index()
{
    $devices = Device::latest()->get();

    $totalDevices = Device::count();

    $activeDevices = Device::where('status',1)->count();

    $inactiveDevices = Device::where('status',0)->count();

    $onlineDevices = Device::where('online_status',1)->count();

    $offlineDevices = Device::where('online_status',0)->count();

    return view('devices.index', compact(
        'devices',
        'totalDevices',
        'activeDevices',
        'inactiveDevices',
        'onlineDevices',
        'offlineDevices'
    ));
}




    public function create()
    {

        return view('devices.create');

    }




    public function store(Request $request)
    {


        $request->validate([


            'name' => 'required',

            'type' => 'required',

            'device_code' => 'required|unique:devices',

        ]);




        Device::create([


            'name'=>$request->name,

            'type'=>$request->type,

            'device_code'=>$request->device_code,

            'ip_address'=>$request->ip_address,

            'location'=>$request->location,

            'status'=>$request->status ?? 1,


            'api_token'=>Str::random(60),


        ]);




        return redirect()

            ->route('devices.index')

            ->with('success','Device Added Successfully');


    }





    public function show(Device $device)
    {

        return view('devices.show',compact('device'));

    }





    public function edit(Device $device)
    {

        return view('devices.edit',compact('device'));

    }





    public function update(Request $request, Device $device)
    {


        $request->validate([


            'name'=>'required',

            'type'=>'required',

        ]);




        $device->update([


            'name'=>$request->name,

            'type'=>$request->type,

            'device_code'=>$request->device_code,

            'ip_address'=>$request->ip_address,

            'location'=>$request->location,

            'status'=>$request->status,


        ]);




        return redirect()

            ->route('devices.index')

            ->with('success','Device Updated Successfully');


    }





    public function destroy(Device $device)
    {


        $device->delete();



        return redirect()

            ->route('devices.index')

            ->with('success','Device Deleted Successfully');


    }


}