<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    public function doctor()
    {
        return $this->hasMany('App\Models\Doctor');
    }
}
