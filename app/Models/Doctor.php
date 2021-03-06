<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;

    const NOTSENT = 'Not Sent';    // Request for sponseered
    const SENT = 'Sent';     // Sponsored request sent
    const ACCEPTED = 'Accepted';     // You are sponsered
    const CANCELLED = 'Cancelled';   // Sponsered request cancelled
    const YES = 'Yes';
    const NO = 'No';

    protected $fillable = ["user_id", "country_id", "state_id", "city_id", "speciality_id", "gender_id", "name", "about", "dob", "pic", "mobile", "phone", "alt_moblie", "fax", "email", "address", "zip", "latitude", "longitude", "website", "status", "sponsored", "physical", "video", "auto_approved", "request_for_sponsored"];

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
    public function doctorSpacilityMap()
    {
        return $this->hasMany('App\Models\DoctorSpacilityMap');
    }
    public function doctorAffiliationMap()
    {
        return $this->hasMany('App\Models\DoctorAffiliationMap');
    }
   
    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment');
    }
    public function review()
    {
        return $this->hasMany('App\Models\Review')->selectRaw('SUM(wating_rate) as total');
    
        return $this->hasMany('App\Models\Review');
    }
    
}
