<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendce extends Model
{
    protected $fillable = ['delivery_id','attendance','withdrawal' ];

    function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }
}
