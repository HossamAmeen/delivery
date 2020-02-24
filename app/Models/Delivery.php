<?php

namespace App\Models;
use  Carbon;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = ['name', 'email', 'password',
        'phone', 'phone2', 'address', 'address2', 'attendance', 'departure',
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
}
