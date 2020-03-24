<?php

namespace App\Models;
use  Carbon;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Delivery extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $fillable = ['name', 'email', 'password',
        'phone', 'phone2','daily_money', 'delivery_ratio','address', 'address2', 'attendance', 'departure',
        'is_free', 'money','deduction', 'city_id',
    ];
    protected $hidden = [
        'password',
    ];

    // protected $casts = [
    //     'attendance' => 'hh:mm',
    //     'departure' => 'hh:mm',
    //     'begin' => 'hh:mm',
    // ];
    
  
    public function setAttendanceAttribute($value)
    {

        $this->attributes['attendance'] = date("H:i", strtotime($value));
    }

    public function setDepartureAttribute($value)
    {
        $this->attributes['departure'] = date("H:i", strtotime($value));
    }
    public function getAttendanceAttribute($value)
    {
        return date("H:i", strtotime($value) );
      
    }

    public function getDepartureAttribute($value)
    {
        return date("H:i", strtotime($value) );
      
    }
    public function sanctions()
    {
       return $this->hasMany(Sanction::class); //->sum('deduction')
    }
    public function sumS()
    {
        return   Sanction::where('delivery_id' , $this->id)->whereMonth('date' , now())->sum('deduction');
    }
    
}
