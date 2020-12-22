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



}
