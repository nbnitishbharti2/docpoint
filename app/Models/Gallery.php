<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //
    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }
}
