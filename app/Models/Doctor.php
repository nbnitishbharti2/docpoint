<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;

    protected $fillable = ["user_id", "country_id", "state_id", "city_id", "speciality_id", "gender_id", "name", "about", "dob", "pic", "mobile", "phone", "alt_moblie", "fax", "email", "address", "zip", "latitude", "longitude", "website", "status"];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

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


    public function speciality()
    {
        return $this->belongsTo('App\Models\Speciality');
    }
    
    public function gender()
    {
        return $this->belongsTo('App\Models\Gender');
    }
    public function AppointmentSlots()
    {
        return $this->hasMany('App\Models\AppointmentSlots');
    }
}
