<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Show Registration Form
    public function register()
    {
        return view('users.register');
    }

    //create new user
    public function store(Request $request)
    {
        $formfields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        // Hash password
        $formfields['password'] = bcrypt($formfields['password']);

        $user = User::create($formfields);

        //after we create the user we want to login.
        auth()->login($user);

        return redirect('/')->with('success', 'Succesfully created new user and logged in') ;
    }

    //logout the user
    public function logout(Request $request)
    {
        auth()->logout();

        //invalidate their session regenerate their token.
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'You have been logged out.');
    }


    //Show the login form
    public function login()
    {
        return view('users.login');
    } 

    //actually login/authenticate the user
    public function authenticate(Request $request)
    {
        $formfields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        //we need to attemp to log the user in with a method called attempt

        if(auth()->attempt($formfields))
        {
            //returns truue so we generate session Id
            $request->session()->regenerate();

            return redirect('/')->with('success', 'Successfully logged In');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
