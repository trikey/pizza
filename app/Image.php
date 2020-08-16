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
        return asset($this->path);
    }
}
