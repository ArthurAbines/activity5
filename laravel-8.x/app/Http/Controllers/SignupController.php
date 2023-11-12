<?php

namespace App\Http\Controllers;
use App\Models\Signup;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth; // Correct import statement


class SignupController extends Controller
{

    public function navigation()
    {
        return view('navigation_layout');
    }

    public function dashboard_index()
    {
        return view('dashboard');
    }

    public function index()
    {
        return view('signup_form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'user_tel' => 'required',
            'password' => 'required|string|min:6',
        ]);
        
        Signup::create([
            'full_name'    => $request->full_name,
            'email_address' => $request->email,
            'user_tel' => $request->user_tel,
            'password'     => $request->password,
        ]);

        return redirect()->intended('login');
    }

}
