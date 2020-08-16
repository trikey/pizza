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

    protected $appends = [
        'sum'
    ];

    public function getSumAttribute()
    {
        return $this->price * $this->quantity;
    }

    public function product()
    {
        return $this->BelongsTo(Product::class);
    }
}
