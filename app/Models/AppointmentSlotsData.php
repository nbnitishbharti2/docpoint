<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentSlotsData extends Model
{
    protected $table = "appointment_slots_data";

    protected $fillable = ["doctor_id", "start_date", "end_date", "start_time", "end_time", "interval", "days", "appointment_type"];


    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }
}
