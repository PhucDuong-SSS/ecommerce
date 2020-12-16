<?php
namespace App\Http\Repo\CouponRepo;

use App\Http\Repo\BaseRepository;
use App\Models\Coupon;

class CouponRepository extends BaseRepository implements CouponRepositoryInterface
{
    public function __construct(Coupon $model)
    {
        parent::__construct($model);
    }

    public function create($request)
    {
        $this->model->name =$request->coupon_name;
        $this->model->discount =$request->discount;
        $this->model->save();
    }

    public function update($request, $obj)
    {
        $obj->name = $request->coupon_name;
        $obj->name = $request->discount;
        $obj->save();
    }
}
