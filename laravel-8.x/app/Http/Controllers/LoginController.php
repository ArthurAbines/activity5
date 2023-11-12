<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signup;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    //
    public function index()
    {
        return view('login_form');
    }

    public function login_user(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        if (Auth::attempt(['email_address' => $credentials['email'], 'password' => $credentials['password']])) {
            return redirect()->intended('dashboard');
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
        
    }

    public function showAllUsers()
    {
        $users = Signup::all();
        return view('login_form', ['users' => $users]);
    }
}
