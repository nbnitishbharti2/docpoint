<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PremiumCharge extends Model
{
    protected $table = "premium_charge";

    protected $fillable = ["doctor_id", "amount", "no_of_patient", "premium_patient"];
}
