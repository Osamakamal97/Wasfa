<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    public function loginForm()
    {
        return view('admin.auth.login');
    }

    // public function registrationForm()
    // {
    //     return view('admin.auth.registration');
    // }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $auth = Auth::guard('admin')->attempt($credentials);
        if ($auth) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->withInput($request->all())->with('error', 'password error');
        }
    }

    // public function register(RegisterRequest $request)
    // {
    //     User::create($request->validated());
    //     return redirect()->route('loginForm')->with('success', 'User created successfully.');
    // }

    public function logout()
    {
        $d = Auth::guard('admin')->logout();
        return redirect()->route('loginForm');
    }
}
