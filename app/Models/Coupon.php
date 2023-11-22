<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    
       protected $fillable = [
        'header_text',
        'discount',
        'coupon_code',
        'expiry_date',
        'is_feature', 
    ];
}
