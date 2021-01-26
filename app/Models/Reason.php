<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    //
    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment');
    }
}
