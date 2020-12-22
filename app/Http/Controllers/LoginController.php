<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;


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
            $notification = [
                'message'=>'User or Password not match',
                'alert-type'=>'error'
            ];
            return redirect()->route('login')->with($notification);
        }
        else
        {
            $notification = [
                'message'=>'Successfully login',
                'alert-type'=>'success'
            ];
            return redirect()->route('dashboard.show')->with($notification);
        }
    }
    public function logout()
    {
        Auth::logout();
        $notification = [
            'message'=>'Successfully logout',
            'alert-type'=>'success'
        ];
        return redirect()->route('login')->with($notification);
    }
}
