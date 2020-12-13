<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showChangePassword()
    {
        return view('admin.layout.passwordchange');
    }

    public function updatePassword(Request $request)
    {
        $password = Auth::user()->password;
        $oldPassword = $request->oldpassword;
        $newPassword = $request->newpassword;
        $comfirmationPassword = $request->password_confirmation;
        $checkPassword = Hash::check($oldPassword,$password);
        if($checkPassword)
        {
            if($newPassword === $comfirmationPassword)
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($newPassword);
                $user->save();
                Auth::logout();

                $notification = [
                    'message'=>'Password Changed Successfully ! Now Login with Your New Password',
                    'alert-type'=>'success'
                ];
                return redirect()->route('login')->with($notification);

            }
            else
            {
                $notification = [
                    'message'=>'Password and confirm password not match',
                    'alert-type'=>'warning'
                ];
                return redirect()->back()->with($notification);

            }
        }
        else
        {
            $notification = [
                'message'=>'Password and old password not match',
                'alert-type'=>'error'
            ];
            return back()->with($notification);
        }
    }
}
