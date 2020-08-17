<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPropertyValue extends Model
{
    protected $fillable = [
        'order_id',
        'order_property_id',
        'value',
    ];
}
