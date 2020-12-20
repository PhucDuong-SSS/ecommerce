<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Repo\CustomerRepo\CustomerRepositoryInterface;

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
}
