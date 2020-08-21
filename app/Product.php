<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Currency;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'category_id',
        'is_popular',
    ];

    protected $appends = [
        'formatted_price',
    ];

    public function getFormattedPriceAttribute()
    {
        return Currency::formatPrice($this->price);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePopular($query)
    {
        return $query->where('is_popular', 1);
    }
}
