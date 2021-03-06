<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Yadahan\AuthenticationLog\AuthenticationLogable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, AuthenticationLogable;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile', 'password', 'status', 'pic', 'country_id', 'state_id', 'city_id', 'gender_id', 'address', 'zip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function getGroupAliasByUserId(int $id){
    //     return DB::table('user_groups')->select('alias_name as user_group_alias')->where('id', '=', $id)->first();
    // }

    // public function getDoctorDataByUserId(int $userId){
    //     return DB::table('doctors')->where('user_id', '=', $userId)->first();
    // }

    public function roles()
    {
        return $this->hasOne('App\Models\UserRole');
    }

    public function doctors()
    {
        return $this->hasOne('App\Models\Doctor');
    }

    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment');
    }
}
