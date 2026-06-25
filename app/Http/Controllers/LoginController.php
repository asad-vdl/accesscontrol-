<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function showLogin()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {

        $credentials = $request->validate([

            'email' => 'required|email',

            'password' => 'required',

        ]);


        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // User Active hona chahiye
            if (!Auth::user()->status) {

                Auth::logout();

                return back()->with(
                    'error',
                    'Your account is inactive.'
                );

            }

            // Sirf Admin login kar sakta hai
            if (Auth::user()->role != 'admin') {

                Auth::logout();

                return back()->with(
                    'error',
                    'You are not authorized to access the Admin Panel.'
                );

            }

            return redirect()->route('dashboard');

        }


        return back()->with(
            'error',
            'Invalid Email or Password.'
        );

    }



    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');

    }

}