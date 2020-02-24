<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sanction extends Model
{
    protected $fillable = ['date' , 'deduction' ,'reason', 'delivery_id'];

    function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }
}
