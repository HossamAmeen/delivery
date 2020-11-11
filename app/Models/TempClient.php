<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempClient extends Model
{
    protected $fillable = [
        'name' , 'email' , 'password' ,'phone' ,'phone2' ,'google_id',
        'address', 'address2' , 'money','job', "is_block","block_reason",'city_id', 'user_id'
    ];
}
