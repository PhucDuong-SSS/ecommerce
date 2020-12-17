<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'sub_category_id','id');
    }
}
