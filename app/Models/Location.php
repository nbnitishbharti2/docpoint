<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    //
     use SoftDeletes;
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }
    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }
}
