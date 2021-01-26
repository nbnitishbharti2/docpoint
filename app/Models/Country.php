<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    //
    use SoftDeletes;
    public function city()
    {
        return $this->hasMany('App\Models\City');
    }
    // public function doctors()
    // {
    //     return $this->morphMany(Doctor::class, 'id');
    // }
}
