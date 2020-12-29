<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Repo\UserRepo\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    private $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

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

    public function showUser()
    {
        $type = 2;
        $users = $this->userRepository->getAdminByType($type);
        return view('admin.role.showall', compact('users'));
    }

    public function createUser()
    {
        return view('admin.role.createUser');
    }

    public function storeUser(UserRequest $request)
    {
        $this->userRepository->store($request);
        $notification = [
            'message'=>'Successfully created new user',
            'alert-type'=>'success'
        ];
        return back()->with($notification);
    }
    public function showFormEdit($id)
    {
        $user =$this->userRepository->findById($id);
        return view('admin.role.editUser', compact('user'));
    }

    public function updateUser(Request $request, $id): RedirectResponse

    {
        $user = $this->userRepository->findById($id);
        $this->userRepository->update($user, $request);
        $notification = [
            'message'=>'Successfully updated user',
            'alert-type'=>'success'
        ];
        return redirect()->route('admin.showUser')->with($notification);
    }
    public function deleteUser($id)
    {
        $this->userRepository->delete($id);
        $notification = [
            'message'=>'Successfully deleted user',
            'alert-type'=>'success'
        ];
        return back()->with($notification);
    }

    public function showHome()
    {
        $date = date('d-m-y');
        $month = date('F');
        $year = date('Y');
        $totalofDay =$this->userRepository->getTotalofDay($date);
        $totalofMonth =$this->userRepository->getTotalofMonth($month);
        $totalofYear =$this->userRepository->getTotalofYear($year);
        $deliveryofDay = $this->userRepository->getDeliveryThisDay($date);
        $orderReturns = $this->userRepository->getOrderReturn();
        $products = $this->userRepository->getProduct();
        $brands = $this->userRepository->getBranch();
        $customers = $this->userRepository->getCustomer();
        return view('admin.home.showHome',compact('totalofDay','totalofMonth','totalofYear','deliveryofDay','products','customers','brands','orderReturns'));
    }


}
