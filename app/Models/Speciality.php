<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Speciality extends Model
{
    use SoftDeletes;

    protected $fillable = ["spec_name", "pic"];

    protected static function boot()
    {
        parent::boot();

        self::created(function($model){
            self::deleteCache($model);
        });

        self::updated(function($model){
            self::deleteCache($model);
        });

        self::deleted(function($model){
            self::deleteCache($model);
        });
    }


    private static function deleteCache($model){
        Cache::forget('get-specialities');
    }

    public static function getSpecialities()
    {
        return Cache::rememberForever('get-specialities', function () {
            $specialities = Speciality::where(['status'=> 'Active'])->pluck('spec_name','id');
            return $specialities;
        });
    }
}
