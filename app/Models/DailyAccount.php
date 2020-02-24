<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyAccount extends Model
{
    protected $fillable = ['date','expenses','note'];

}
