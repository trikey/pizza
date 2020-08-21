<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Currency;

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
        'sum',
        'price_formatted',
        'sum_formatted',
    ];

    public function getSumAttribute()
    {
        return $this->price * $this->quantity;
    }

    public function getPriceFormattedAttribute()
    {
        return Currency::formatPrice($this->price);
    }

    public function getSumFormattedAttribute()
    {
        return Currency::formatPrice($this->getSumAttribute());
    }

    public function product()
    {
        return $this->BelongsTo(Product::class);
    }

    public function scopeNotOrdered($query)
    {
        return $query->whereOrderId(null);
    }
}
