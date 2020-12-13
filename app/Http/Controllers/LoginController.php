<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('admin.layout.login');
    }
    public function login(Request $request)
    {

        $admin = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        if(!Auth::attempt($admin))
        {
            return redirect()->route('login')->with('login-error','User or Password not match');
        }
        else
        {
            return view('admin.layout.home');
        }
    }
    public function logout()
    {

    }
}
