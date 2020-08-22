<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = [
        'path',
        'disk',
        'imageable_type',
        'imageable_id',
        'base64',
    ];

    protected $appends = [
        'url'
    ];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function getUrlAttribute()
    {
        return 'data:image/jpeg;base64,' . $this->base64;
    }
}
