<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


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
        return view('users.create');
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

        ]);



        User::create([

            'name' => $request->name,

            'email' => $request->email,

            'phone' => $request->phone,

            'employee_id' => $request->employee_id,

            'password' => Hash::make($request->password),

            'status' => 1,

        ]);



        return redirect()
                ->route('users.index')
                ->with('success','User Created Successfully');

    }




    /**
     * Show single user
     */
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }





    /**
     * Edit user page
     */
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }





    /**
     * Update user
     */
    public function update(Request $request, User $user)
    {


        $request->validate([

            'name'=>'required',

            'email'=>'required|email',

        ]);



        $user->update([

            'name'=>$request->name,

            'email'=>$request->email,

            'phone'=>$request->phone,

            'employee_id'=>$request->employee_id,

            'status'=>$request->status,

        ]);



        return redirect()
                ->route('users.index')
                ->with('success','User Updated Successfully');

    }





    /**
     * Delete user
     */
    public function destroy(User $user)
    {

        $user->delete();


        return redirect()
                ->route('users.index')
                ->with('success','User Deleted Successfully');

    }


}