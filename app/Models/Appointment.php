<?php

namespace App\Models;
use App\Models\Doctor;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ["user_id","doctor_id", "appointment_slot_id", "reason_id", "patient_type", "appointment_type", "appointment_date"];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function doctors()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function appointment_slot()
    {
        return $this->belongsTo('App\Models\AppointmentSlots');
    }

    public function reason()
    {
        return $this->belongsTo('App\Models\Reason');
    }
}
