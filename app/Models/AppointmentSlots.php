<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AppointmentSlots extends Model
{
    use SoftDeletes;

    protected $fillable = ["doctor_id", "slot_date", "slot_date_time", "slot_time", "status"];
}
