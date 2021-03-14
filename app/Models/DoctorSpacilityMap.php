<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorSpacilityMap extends Model
{
    protected $fillable = [
        'doctor_id', 'speciality_id'
    ];


    // public function reason()
    // {
    //     return $this->hasMany('App\Models\Reason');
    // }
    
    public function reason()
    {
        return $this->belongsTo('App\Models\Reason');
    }
}
