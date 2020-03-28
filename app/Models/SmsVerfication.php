<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsVerfication extends Model
{
    protected $fillable = [
        'contact_number','code','status' , 'token'
        ];
}
