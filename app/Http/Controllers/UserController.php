<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Gate;
use App\Models\UserGatePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\UserAccessSchedule;



class UserController extends Controller
{


    public function index()
    {

       $users = User::with('gates.devices')
            ->latest()
            ->get();


        $totalUsers = User::count();


        $activeUsers = User::where('status',1)->count();


        $inactiveUsers = User::where('status',0)->count();



        return view('users.index',compact(

            'users',
            'totalUsers',
            'activeUsers',
            'inactiveUsers'

        ));

    }






    public function create()
{
    $gates = Gate::where('status', 1)
        ->orderBy('name')
        ->get();

        $defaultSchedule = [

    'monday' => true,
    'tuesday' => true,
    'wednesday' => true,
    'thursday' => true,
    'friday' => true,
    'saturday' => false,
    'sunday' => false,

    'start_time' => '08:00',

    'end_time' => '18:00',

    'valid_from' => null,

    'valid_to' => null,

    'status' => true,

];

    return view('users.create', compact(

    'gates',

    'defaultSchedule'

));
}







    public function store(Request $request)
    {


        $request->validate([


            'name'=>'required',


            'email'=>'required|email|unique:users',


            'password'=>'required|min:6',


            'role'=>'required',


            'photo'=>'nullable|image|mimes:jpg,jpeg,png|max:2048',


        ]);






        $photo=null;



        if($request->hasFile('photo')){


            $photo=$request->file('photo')
                    ->store('users','public');


        }







        $user=User::create([


            'name'=>$request->name,


            'email'=>$request->email,


            'phone'=>$request->phone,


            'employee_id'=>$request->employee_id,


            'photo'=>$photo,


            'password'=>Hash::make($request->password),


            'role'=>$request->role,


            'status'=>$request->status ?? 1,


        ]);








        // Gate Permissions

        if($request->filled('gate_ids')){


            foreach($request->gate_ids as $gateId){



                UserGatePermission::create([


                    'user_id'=>$user->id,


                    'gate_id'=>$gateId,


                    'access_allowed'=>1,


                ]);


            }


        }


// Access Schedule

UserAccessSchedule::create([

    'user_id' => $user->id,

    'monday' => $request->has('monday'),

    'tuesday' => $request->has('tuesday'),

    'wednesday' => $request->has('wednesday'),

    'thursday' => $request->has('thursday'),

    'friday' => $request->has('friday'),

    'saturday' => $request->has('saturday'),

    'sunday' => $request->has('sunday'),

    'start_time' => $request->start_time,

    'end_time' => $request->end_time,

    'valid_from' => $request->valid_from,

    'valid_to' => $request->valid_to,

    'status' => $request->schedule_status ?? 1,

]);



        return redirect()

            ->route('users.index')

            ->with('success','User Created Successfully');



    }









    public function show(User $user)
    {


        return view('users.show',compact('user'));

    }









    public function edit(User $user)
{
    $gates = Gate::where('status', 1)
        ->orderBy('name')
        ->get();

    $assignedGates = UserGatePermission::where('user_id', $user->id)
        ->where('access_allowed', 1)
        ->pluck('gate_id')
        ->toArray();

        $schedule = UserAccessSchedule::firstOrCreate(

    ['user_id' => $user->id],

    [

        'start_time' => '08:00:00',

        'end_time' => '18:00:00',

    ]

);

    return view('users.edit', compact(
        'user',
        'gates',
        'assignedGates',
        'schedule',
    ));
}








    public function update(Request $request,User $user)
    {


        $request->validate([


            'name'=>'required',


            'email' => 'required|email|unique:users,email,' . $user->id,


            'role'=>'required',


            'photo'=>'nullable|image|mimes:jpg,jpeg,png|max:2048',


        ]);







        $photo=$user->photo;





        if($request->hasFile('photo')){


            if($user->photo &&
            Storage::disk('public')->exists($user->photo)){


                Storage::disk('public')
                ->delete($user->photo);


            }




            $photo=$request->file('photo')
                    ->store('users','public');


        }








        $user->update([


            'name'=>$request->name,


            'email'=>$request->email,


            'phone'=>$request->phone,


            'employee_id'=>$request->employee_id,


            'photo'=>$photo,


            'role'=>$request->role,


            'status'=>$request->status,


        ]);







        // Remove old gate permissions

        UserGatePermission::where('user_id',$user->id)
                ->delete();








        // Add new gate permissions

        if($request->filled('gate_ids')){


            foreach($request->gate_ids as $gateId){



                UserGatePermission::create([


                    'user_id'=>$user->id,


                    'gate_id'=>$gateId,


                    'access_allowed'=>1,


                ]);


            }


        }



// Update Access Schedule

UserAccessSchedule::updateOrCreate(

    [

        'user_id' => $user->id

    ],

    [

        'monday' => $request->has('monday'),

        'tuesday' => $request->has('tuesday'),

        'wednesday' => $request->has('wednesday'),

        'thursday' => $request->has('thursday'),

        'friday' => $request->has('friday'),

        'saturday' => $request->has('saturday'),

        'sunday' => $request->has('sunday'),

        'start_time' => $request->start_time,

        'end_time' => $request->end_time,

        'valid_from' => $request->valid_from,

        'valid_to' => $request->valid_to,

        'status' => $request->schedule_status ?? 1,

    ]

);




        return redirect()

            ->route('users.index')

            ->with('success','User Updated Successfully');



    }









    public function destroy(User $user)
    {


        if($user->photo &&
        Storage::disk('public')->exists($user->photo)){


            Storage::disk('public')
            ->delete($user->photo);


        }






        UserGatePermission::where('user_id',$user->id)
                ->delete();

                UserAccessSchedule::where('user_id', $user->id)
    ->delete();





        $user->delete();






        return redirect()

            ->route('users.index')

            ->with('success','User Deleted Successfully');



    }



}