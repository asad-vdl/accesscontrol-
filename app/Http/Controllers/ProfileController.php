<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show Profile Page
     */
    public function edit()
    {
        return view('profile.edit', [

            'user' => Auth::user()

        ]);
    }

    /**
     * Update Profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email,' . $user->id,

            'phone' => 'nullable|string|max:30',

            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'current_password' => 'nullable|required_with:password',

            'password' => 'nullable|min:6|confirmed',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Upload Photo
        |--------------------------------------------------------------------------
        */

        $photo = $user->photo;

        if ($request->hasFile('photo')) {

            if (

                $user->photo &&

                Storage::disk('public')->exists($user->photo)

            ) {

                Storage::disk('public')->delete($user->photo);

            }

            $photo = $request->file('photo')
                ->store('users', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Update Basic Information
        |--------------------------------------------------------------------------
        */

        $data = [

            'name' => $request->name,

            'email' => $request->email,

            'phone' => $request->phone,

            'photo' => $photo,

        ];


        /*
        |--------------------------------------------------------------------------
        | Update Password (Optional)
        |--------------------------------------------------------------------------
        */

        if ($request->filled('password')) {

            if (

                !Hash::check(

                    $request->current_password,

                    $user->password

                )

            ) {

                return back()

                    ->withErrors([

                        'current_password' => 'Current password is incorrect.'

                    ])

                    ->withInput();

            }

            $data['password'] = Hash::make(

                $request->password

            );

        }


        /*
        |--------------------------------------------------------------------------
        | Save
        |--------------------------------------------------------------------------
        */

        $user->update($data);


        return redirect()

            ->route('profile.edit')

            ->with(

                'success',

                'Profile Updated Successfully.'

            );

    }
}