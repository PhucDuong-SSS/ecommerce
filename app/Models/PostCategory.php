<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;
    protected $table = 'post_categories';

    public function posts()
    {
        return $this->hasMany(PostCategory::class, 'post_category_id', 'id');
    }
}
