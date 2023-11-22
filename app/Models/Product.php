<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function galleries()
    {
        return $this->hasMany(Gallary::class);
    }
    public function category(){
        return $this->belongsTo(Category::class,'cat_id','id');
    }
    public function subCategory(){
        return $this->belongsTo(SubCategory::class,'sub_cat_id','id');
    }
    public function review()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }
  
}
