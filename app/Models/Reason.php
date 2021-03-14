<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Reason extends Model
{
    use SoftDeletes;

    const ACTIVE = 'Active';
    const NEW = 'New';

    protected $fillable = ['speciality_id', 'name', 'status'];

    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment');
    }

    public function speciality()
    {
        return $this->belongsTo('\App\Models\Speciality');
    }

    public static function getStatusOption(){
		return [
			self::NEW => self::NEW,
			self::ACTIVE => self::ACTIVE,
		];
	}

}
