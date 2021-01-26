<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id', 'doctor_id', 'wating_rate', 'rate', 'review_desc','review_title', 'status'];

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
