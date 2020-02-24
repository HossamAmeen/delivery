<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendce extends Model
{
    protected $fillable = ['delivery_id','attendance','departure' , 'delay_excuse' ,'deduction' ];

    function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

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
