<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }

    public function orderdetail()
    {
        return $this->hasOne(OrderDetails::class, 'product_id', 'id');
    }
    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class, 'product_id', 'id');
    }
    public function getUrl()
    {
        return "https://phucduongc8.s3.amazonaws.com/";
    }


}
