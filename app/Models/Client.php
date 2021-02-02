<?php

namespace App\Models;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\Model;

class Client extends Authenticatable
{
    // use LaratrustUserTrait;
    use HasApiTokens, Notifiable;

    protected $fillable = [ 
        'name' , 'email' , 'password' ,'phone' ,'phone2' ,'google_id',
    'address', 'address2' , 'money','job'
      ,"is_block","is_verified","block_reason",'city_id'
    ];
    protected $hidden = [
        'password',
    ];

    public function setMoneyAttribute($value)
    {
        if($value === null )
        
        $this->attributes['money'] =  0 ;
        else $value;
    }
}
