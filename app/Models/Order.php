<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function ship()
    {
        return $this->hasOne(Shipping::class, 'order_id', 'id');
    }
    public function order_detail()
    {
        return $this->hasOne(OrderDetails::class, 'order_id','id');
    }

}
