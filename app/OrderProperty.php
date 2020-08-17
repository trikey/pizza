<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProperty extends Model
{
    protected $fillable = [
        'name',
        'code',
        'is_phone',
        'is_email',
        'required',
    ];

    protected $appends = [
        'type',
    ];

    public function getTypeAttribute()
    {
        return $this->is_email ? 'email' : 'text';
    }
}
