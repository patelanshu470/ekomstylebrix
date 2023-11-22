<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function reason(){
        return $this->hasOne(CanceledOrder::class,'order_id');
    }
      public function orderedProduct(){
        return $this->hasMany(OrderedProduct::class,'order_id');
    }
}
