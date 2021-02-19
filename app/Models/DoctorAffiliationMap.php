<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorAffiliationMap extends Model
{
    //
    public function affiliation()
    {
        return $this->belongsTo('App\Models\Affiliation');
    }
}
