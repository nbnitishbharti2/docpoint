<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
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
}
