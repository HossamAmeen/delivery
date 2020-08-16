<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['title' , 'client_id' ,'delivery_id', 'price' ,
    'delivery_price','status', 'description' ,
     'phone'  , 'address','rate' , 'review'];

    function delivery()
    {
        return $this->belongsTo(Delivery::class)->select('id' , 'name' , 'phone')->withDefault(['name'=>'لا يوجد ' ]);
    }

    function client()
    {
        return $this->belongsTo(Client::class);
    }

    function images()
    {
        return $this->hasMany(ImagesOrder::class , 'order_id');
    }
}
