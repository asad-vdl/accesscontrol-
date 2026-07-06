<?php

namespace App\Http\Controllers;

use App\Models\UserDevicePermission;
use App\Models\User;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    /**
     * Display users list
     */
    public function index()
    {
        $users = User::latest()->get();

        $totalUsers = User::count();

        $activeUsers = User::where('status', 1)->count();

        $inactiveUsers = User::where('status', 0)->count();

        return view('users.index', compact(
            'users',
            'totalUsers',
            'activeUsers',
            'inactiveUsers'
        ));
    }

    /**
     * Show add user page
     */
   public function create()
{
    $devices = Device::all();

    return view('users.create', compact('devices'));
}

    /**
     * Save new user
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',

            'email' => 'required|email|unique:users',

            'phone' => 'nullable',

            'employee_id' => 'nullable|unique:users',

            'password' => 'required|min:6',

            'role' => 'required',

            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        $photo = null;

        if ($request->hasFile('photo')) {

            $photo = $request->file('photo')->store('users', 'public');

        }

        $user = User::create([

    'name' => $request->name,

    'email' => $request->email,

    'phone' => $request->phone,

    'employee_id' => $request->employee_id,

    'photo' => $photo,

    'password' => Hash::make($request->password),

    'role' => $request->role ?? 'admin',

    'status' => $request->status,

]);
if ($request->has('device_ids')) {

    foreach ($request->device_ids as $deviceId) {


        UserDevicePermission::create([

            'user_id' => $user->id,

            'device_id' => $deviceId,

            'access_allowed' => 1,

        ]);
    }
}

        return redirect()
            ->route('users.index')
            ->with('success', 'User Created Successfully');
    }

    /**
     * Show single user
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Edit user page
     */
    public function edit(User $user)
{
    $devices = Device::all();

    $assignedDevices = UserDevicePermission::where(
        'user_id',
        $user->id
    )->pluck('device_id')->toArray();

    return view(
        'users.edit',
        compact(
            'user',
            'devices',
            'assignedDevices'
        )
    );
}
        /**
     * Update user
     */
    public function update(Request $request, User $user)
    {

        $request->validate([

            'name' => 'required',

            'email' => 'required|email',

            'role' => 'required',

            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);


        $photo = $user->photo;

        if ($request->hasFile('photo')) {

            if ($user->photo && Storage::disk('public')->exists($user->photo)) {

                Storage::disk('public')->delete($user->photo);

            }

            $photo = $request->file('photo')->store('users', 'public');

        }


        $user->update([

            'name' => $request->name,

            'email' => $request->email,

            'phone' => $request->phone,

            'employee_id' => $request->employee_id,

            'photo' => $photo,

            'role' => $request->role,

            'status' => $request->status,

        ]);

        UserDevicePermission::where(
    'user_id',
    $user->id
)->delete();

if ($request->has('device_ids')) {

    foreach ($request->device_ids as $deviceId) {

        UserDevicePermission::create([

            'user_id' => $user->id,

            'device_id' => $deviceId,

            'access_allowed' => 1,

        ]);

    }

}


        return redirect()
                ->route('users.index')
                ->with('success', 'User Updated Successfully');

    }



    /**
     * Delete user
     */
    public function destroy(User $user)
    {

        if ($user->photo && Storage::disk('public')->exists($user->photo)) {

            Storage::disk('public')->delete($user->photo);

        }

        $user->delete();

        return redirect()
                ->route('users.index')
                ->with('success', 'User Deleted Successfully');

    }

}