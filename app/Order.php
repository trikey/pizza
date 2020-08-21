<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Currency;

class Order extends Model
{
    protected $fillable = [
        'products_price',
        'delivery_price',
        'total',
        'user_id',
    ];

    protected $appends = [
        'products_price_formatted',
        'delivery_price_formatted',
        'total_formatted',
    ];

    public function getProductsPriceFormattedAttribute()
    {
        return Currency::formatPrice($this->products_price);
    }

    public function getDeliveryPriceFormattedAttribute()
    {
        return Currency::formatPrice($this->delivery_price);
    }

    public function getTotalFormattedAttribute()
    {
        return Currency::formatPrice($this->total);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
