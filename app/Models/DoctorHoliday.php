<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorHoliday extends Model
{
    protected $fillable = ["doctor_id", "date", "leave_day"];
    
    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }
}
