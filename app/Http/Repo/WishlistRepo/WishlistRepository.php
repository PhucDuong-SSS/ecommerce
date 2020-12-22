<?php
namespace App\Http\Repo\WishlistRepo;

use App\Http\Repo\BaseRepository;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class WishlistRepository extends BaseRepository implements WishlistRepositoryInterface
{
    public function __construct(Wishlist $model)
    {
        parent::__construct($model);
    }
    public function check($id)
    {
        $customerId = Auth::guard('customer')->id();
        $check = $this->model->where('customer_id',$customerId)->where('product_id',$id)->first();
        return $check;
    }

    public function checkLogin()
    {
        $flag = Auth::guard('customer')->check();
        return $flag;
    }
    public function store($id)
    {
        $customerId = Auth::guard('customer')->id();
        $this->model->customer_id = $customerId;
        $this->model->product_id = $id;
        $this->model->save();
    }
    public function count()
    {
        $customerId = Auth::guard('customer')->id();
        $count = $this->model->where('customer_id',$customerId)->count();
        return $count;
    }
}
