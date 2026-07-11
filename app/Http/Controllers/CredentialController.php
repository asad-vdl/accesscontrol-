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

            'user_id' => 'required',
            'credential_type' => 'required',
            'credential_value' => 'required|unique:credentials',

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



        public function update(
        Request $request,
        Credential $credential
    )
    {

        $request->validate([

            'user_id' => 'required',
            'credential_type' => 'required',
            'credential_value' => 'required',

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
            ->with(
                'success',
                'Credential Updated Successfully'
            );
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