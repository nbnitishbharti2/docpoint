<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Reason extends Model
{
    use SoftDeletes;
    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment');
    }
}
