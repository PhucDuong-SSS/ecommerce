<?php
namespace App\Http\Repo\OrderRepo;

use App\Http\Repo\BaseRepository;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function getOrderByStatus($status)
    {
        $orders  = $this->model->where('status',$status)->get();
        return $orders;
    }

    public function getDetails($id)
    {
        $details = DB::table('order_details')
            ->join('products','order_details.product_id','products.id')
            ->select('order_details.*','products.code','products.image_one','products.color','products.name')
            ->where('order_details.order_id',$id)
            ->get();
        return $details;
    }
    public function changeStatus($obj, $status)
    {
        $obj->status = $status;
        $obj->save();
    }

    public function subQuantity($id)
    {
        $product = DB::table('order_details')->where('order_id',$id)->get();
        foreach ($product as $row) {
            DB::table('products')
                ->where('id',$row->product_id)
                ->update(['quantity' => DB::raw('quantity-'.$row->quantity),
                    'sold' => DB::raw('sold+'.$row->quantity)]);
        }
    }
}
