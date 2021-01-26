<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorRegistration extends Model
{
    protected $fillable = [
        'name', 'email', 'mobile', 'address',
    ];
}
