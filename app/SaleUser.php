<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleUser extends Model
{
    protected $fillable = [
        'user_id',
        'code',
    ];
}
