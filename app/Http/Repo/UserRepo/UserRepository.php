<?php


namespace App\Http\Repo\UserRepo;


use App\Http\Repo\BaseRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getAdminByType($type)
    {
        $users = $this->model->where('type',$type)->get();
        return $users;
    }
    public function store($request)
    {
        $this->model->name = $request->name;
        $this->model->username = $request->username;
        $this->model->phone = $request->phone;
        $this->model->email = $request->email;
        $this->model->password = Hash::make($request->password);
        $this->model->category = $request->category;
        $this->model->coupon = $request->coupon;
        $this->model->product = $request->product;
        $this->model->blog = $request->blog;
        $this->model->order = $request->order;
        $this->model->other = $request->other;
        $this->model->report = $request->report;
        $this->model->role = $request->role;
        $this->model->return = $request->return;
        $this->model->contact = $request->contact;
        $this->model->comment = $request->comment;
        $this->model->setting = $request->setting;
        $this->model->type = 2;
        $this->model->save();
    }
    public function update($obj, $request)
    {
       $obj->name = $request->name;
       $obj->username = $request->username;
       $obj->phone = $request->phone;
       $obj->email = $request->email;
       $obj->password = Hash::make($request->password);
       $obj->category = $request->category;
       $obj->coupon = $request->coupon;
       $obj->product = $request->product;
       $obj->blog = $request->blog;
       $obj->order = $request->order;
       $obj->other = $request->other;
       $obj->report = $request->report;
       $obj->role = $request->role;
       $obj->return = $request->return;
       $obj->contact = $request->contact;
       $obj->comment = $request->comment;
       $obj->setting = $request->setting;
       $obj->save();
    }
    public function getTotalofDay($date)
    {
        $totalToday = DB::table('orders')->where('date',$date)->sum('total');
        return $totalToday;
    }
    public function getTotalofMonth($month)
    {
        $totalMonth = DB::table('orders')->where('month',$month)->sum('total');
        return $totalMonth;
    }
    public function getTotalofYear($year)
    {
        $totalYear = DB::table('orders')->where('year',$year)->sum('total');
        return $totalYear;
    }

    public function getDeliveryThisDay($date)
    {
        $delevery = DB::table('orders')->where('date',$date)->where('status',3)->sum('total');
        return $delevery;
    }

    public function getOrderReturn()
    {
        $orderReturns = DB::table('orders')->where('status',4)->sum('total');
        return $orderReturns;
    }
     public function getProduct()
     {
         $products = DB::table('products')->get();
         return $products;
     }
     public function getBranch()
     {
         $brands = DB::table('brands')->get();
         return $brands;
     }
     public function getCustomer()
     {
         $customers = DB::table('customers')->get();
         return $customers;
     }


}
