<?php

namespace App\Http\Controllers;


use App\Models\Device;
use App\Models\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;


class DeviceController extends Controller
{


    public function index()
    {

        $devices = Device::with('gate')
                    ->latest()
                    ->get();



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


        $gates = Gate::where('status', 1)
    ->orderBy('name')
    ->get();



        return view('devices.create',compact('gates'));

    }





    public function store(Request $request)
    {


       $request->validate([

    'gate_id' => 'required|exists:gates,id',

    'name' => 'required|string|max:100',

    'type' => 'required|string|max:50',

    'device_code' => 'required|string|max:100|unique:devices,device_code',

    'ip_address' => 'nullable|ip',

    'location' => 'nullable|string|max:255',

    'status' => 'required|in:0,1',

]);



        Device::create([



            'gate_id'=>$request->gate_id,


            'name'=>$request->name,


            'type'=>$request->type,


            'device_code'=>$request->device_code,


            'ip_address'=>$request->ip_address,


            'location'=>$request->location,


            'status' => $request->status,

            'api_token'=>Str::random(60),



        ]);




        return redirect()

            ->route('devices.index')

            ->with('success','Device Added Successfully');


    }







  public function show(Device $device)
{
    $device->load([

        'gate',

        'accessLogs.user'

    ]);

    $assignedUsers = User::where('status', 1)

        ->whereHas('gates', function ($query) use ($device) {

            $query->where('gates.id', $device->gate_id);

        })

        ->orderBy('name')

        ->get();

    $totalLogs = $device->accessLogs->count();

    $grantedLogs = $device->accessLogs
        ->where('access_status', 'granted')
        ->count();

    $deniedLogs = $device->accessLogs
        ->where('access_status', 'denied')
        ->count();

    $todayLogs = $device->accessLogs
        ->where('created_at', '>=', now()->startOfDay())
        ->count();

    return view('devices.show', compact(

        'device',

        'assignedUsers',

        'totalLogs',

        'grantedLogs',

        'deniedLogs',

        'todayLogs'

    ));
}






    public function edit(Device $device)
    {


        $gates = Gate::where('status', 1)
    ->orderBy('name')
    ->get();



        return view('devices.edit',compact(

            'device',
            'gates'

        ));


    }







    public function update(Request $request, Device $device)
    {



       $request->validate([

    'gate_id' => 'required|exists:gates,id',

    'name' => 'required|string|max:100',

    'type' => 'required|string|max:50',

    'device_code' => 'required|string|max:100|unique:devices,device_code,' . $device->id,

    'ip_address' => 'nullable|ip',

    'location' => 'nullable|string|max:255',

    'status' => 'required|in:0,1',

]);



        $device->update([

    'gate_id' => $request->gate_id,

    'name' => $request->name,

    'type' => $request->type,

    'device_code' => $request->device_code,

    'ip_address' => $request->ip_address,

    'location' => $request->location,

    'status' => $request->status,

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