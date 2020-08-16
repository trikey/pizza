<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'price',
        'order_id',
        'sale_user_id',
    ];
}
