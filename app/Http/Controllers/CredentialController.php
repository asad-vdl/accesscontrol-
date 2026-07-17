<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Credential;
use Illuminate\Http\Request;

class CredentialController extends Controller
{

   public function index()
{
    $credentials = Credential::with([
    'user.gates.devices'
])
->latest()
->get();

    $totalCredentials = Credential::count();

    $activeCredentials = Credential::where(
        'status',
        1
    )->count();

    $inactiveCredentials = Credential::where(
        'status',
        0
    )->count();

    return view(
        'credentials.index',
        compact(
            'credentials',
            'totalCredentials',
            'activeCredentials',
            'inactiveCredentials'
        )
    );
}

    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('credentials.create', compact('users'));
    }


    public function store(Request $request)
    {

        $request->validate([

    'user_id' => 'required|exists:users,id',

    'credential_type' => 'required|string|max:50',

    'credential_value' => 'required|string|max:255|unique:credentials,credential_value',

    'status' => 'required|boolean',

    'notes' => 'nullable|string|max:500',

]);


        Credential::create([

            'user_id' => $request->user_id,
            'credential_type' => $request->credential_type,
            'credential_value' => $request->credential_value,
            'status' => $request->status ?? 1,
            'notes' => $request->notes,

        ]);


        return redirect()
            ->route('credentials.index')
            ->with('success', 'Credential Added Successfully');
    }

        public function edit(Credential $credential)
    {
        $users = User::orderBy('name')->get();

        return view(
            'credentials.edit',
            compact('credential','users')
        );
    }




    public function show(Credential $credential)
{
    $credential->load([

        'user.gates.devices',

        'accessLogs.device'

    ]);

    $totalLogs = $credential->accessLogs->count();

    $grantedLogs = $credential->accessLogs
        ->where('access_status','granted')
        ->count();

    $deniedLogs = $credential->accessLogs
        ->where('access_status','denied')
        ->count();

    $todayLogs = $credential->accessLogs
        ->where('created_at','>=',now()->startOfDay())
        ->count();

    return view(

        'credentials.show',

        compact(

            'credential',

            'totalLogs',

            'grantedLogs',

            'deniedLogs',

            'todayLogs'

        )

    );
}




       public function update(Request $request, Credential $credential)
{

    $request->validate([

        'user_id' => 'required|exists:users,id',

        'credential_type' => 'required|string|max:50',

        'credential_value' => 'required|string|max:255|unique:credentials,credential_value,' . $credential->id,

        'status' => 'required|boolean',

        'notes' => 'nullable|string|max:500',

    ]);

    $credential->update([

        'user_id' => $request->user_id,

        'credential_type' => $request->credential_type,

        'credential_value' => $request->credential_value,

        'status' => $request->status,

        'notes' => $request->notes,

    ]);

    return redirect()
        ->route('credentials.index')
        ->with('success', 'Credential Updated Successfully');
}


        public function destroy(
        Credential $credential
    )
    {

        $credential->delete();

        return redirect()
            ->route('credentials.index')
            ->with(
                'success',
                'Credential Deleted Successfully'
            );
    }

}