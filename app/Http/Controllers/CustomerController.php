<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Repo\CustomerRepo\CustomerRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    private $customerRepository;
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function showFormLogin()
    {
        return view('customer.login');
    }

    public function login(Request $request)
    {
        $customer =[
            'username' => $request->username,
            'password' => $request->password
        ];
        if(!Auth::guard('customer')->attempt($customer))
        {
            $notification = [
                'message'=>'User or Password not match',
                'alert-type'=>'error'
            ];
            return redirect()->route('customer.showFormLogin')->with($notification);
        }
        else
        {
            $notification = [
                'message'=>'Successfully login',
                'alert-type'=>'success'
            ];
            return redirect()->route('index')->with($notification);
        }
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        $notification = [
            'message'=>'Successfully logout',
            'alert-type'=>'success'
        ];
        return redirect()->route('index')->with($notification);
    }
    public function showFormRegister()
    {
        return view('customer.register');
    }

    public function store(CustomerRequest $request)
    {
        $this->customerRepository->create($request);
        $notification = [
            'message'=>'Successfully register, you can login now',
            'alert-type'=>'success'
        ];
        return redirect()->route('customer.showFormLogin')->with($notification);
    }
    public function showProfile()
    {
        $userId = Auth::guard('customer')->id();
        $orders = $this->customerRepository->showOrder($userId);
        return view('customer.profile', compact('orders'));
    }

    public function showFormChangePassword()
    {
        $user = Auth::guard('customer')->user();
        return view('customer.formChangePassword', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $password=Auth::guard('customer')->user()->password;
        $oldpass=$request->oldpass;
        $newpass=$request->password;
        $confirm=$request->password_confirmation;
        if (Hash::check($oldpass,$password)) {
            if ($newpass === $confirm) {
                $user=Customer::find(Auth::guard('customer')->id());
                $user->password=Hash::make($request->password);
                $user->save();
                Auth::guard('customer')->logout();
                $notification=array(
                    'messege'=>'Password Changed Successfully ! Now Login with Your New Password',
                    'alert-type'=>'success'
                );
                return Redirect()->route('customer.login')->with($notification);
            }else{
                $notification= [
                    'messege'=>'New password and Confirm Password not matched!',
                    'alert-type'=>'error'
                ];
                return Redirect()->back()->with($notification);
            }
        }else{
            $notification = [
                'message'=>'Old Password not matched!',
                'alert-type'=>'error'
            ];

            return Redirect()->back()->with($notification);
        }


    }


}
