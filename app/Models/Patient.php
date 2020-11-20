<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }
}
