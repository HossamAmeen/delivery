<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [ 'name' , 'email' , 'password',
    'phone','phone2','address' , 'address2',
     'is_free','money' ,'city_id'
    ];
    protected $hidden = [
        'password',
    ];

}
