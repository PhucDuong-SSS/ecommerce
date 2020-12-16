<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use Illuminate\Http\Request;
use App\Http\Repo\CouponRepo\CouponRepositoryInterface;

class CouponController extends Controller
{
    private $couponRepository;
    public function __construct(CouponRepositoryInterface $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function index()
    {
       $coupons = $this->couponRepository->getAll();
       return view('admin.coupon.list', compact('coupons'));
    }

    public function store(CouponRequest $request)
    {
        $this->couponRepository->create($request);
        $notification = [
            'message'=>'Successfully created coupon',
            'alert-type'=>'success'
        ];
        return redirect()->route('coupon.list')->with($notification);
    }

    public function showFormEdit($id)
    {
        $coupon = $this->couponRepository->findById($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(CouponRequest $request, $id)
    {
        $coupon = $this->couponRepository->findById($id);
        $this->couponRepository->update($request, $coupon);
        $notification = [
            'message'=>'Successfully updated coupon',
            'alert-type'=>'success'
        ];
        return redirect()->route('coupon.list')->with($notification);
    }
    public function delete($id)
    {
        $this->couponRepository->delete($id);
        $notification = [
            'message'=>'Successfully deleted coupon',
            'alert-type'=>'success'
        ];
        return redirect()->route('coupon.list')->with($notification);
    }

}
