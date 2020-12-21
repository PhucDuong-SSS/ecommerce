<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->hasOne(Product::class,'product_id', 'id');
    }
    public function order()
    {
        return $this->hasOne(Order::class, 'order_id', 'id');
    }
}
