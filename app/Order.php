<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'products_price',
        'delivery_price',
        'total',
        'user_id',
    ];
}
